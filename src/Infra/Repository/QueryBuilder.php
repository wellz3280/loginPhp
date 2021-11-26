<?php

/*

Para intaciar a classe é necessario uma conexão com banco.

bancos testados (mysql)

metodos
  parameters recebe um array 
  from recebe o nome da tabela
  where recebe condição, coluna e valores 
  columns as colunas da tabela e retorna um select 
  o default do metodo é * .


 Update
  A ultima chave do array deve ser a que faz a condição.
 Exemplo
 $array->parameters(['name'=>'leblon','lastname'=>'james','age'=> 36, 'id' => 1]);
 
 $query->parameters(['email' => 'valflores@gmail.com','idCliente' => 71, 'idEmail'=> 25])
    ->from('emails')
    ->where('where','idEmail','?')
    ->get('update');

Insert

$query->parameters(['email' => 'mocadasflores@google.com','idCliente' => 71])
    ->from('emails')
    ->get('insert');


    //Delete
    $query->from('emails')
    ->where('where','id',17)
    ->get('delete');

    //SELECT 
    $result = $query
    //->columns(['*'])
    ->columns(['email','idCliente'])
    ->from("emails")
    ->where('where','idEmail',2)
    ->get('select');

    
    foreach($result as  $content){
        echo "email: ".$content['email']. PHP_EOL;
        echo "id Cliente: ".$content['idCliente']. PHP_EOL;
    }
 
*/
   
   namespace Weliton\Login\Infra\Repository;
    use PDOException;
    use PDO;
class QueryBuilder
{
    private \PDO $pdo;

    private array $columns = ['*'];
    private string $table = '';
    private string $where = '';
    private string $query = '';
    private array $data;
    private string $service;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function columns(array $columns = ['*']): QueryBuilder
    {
        $this->columns = $columns;
        
        return $this;
    }

    public function from(string $table): QueryBuilder
    {
        $this->table = $table;

        return $this;
    }

    public function where(string $condition ,string $columns,  string $value): QueryBuilder
    {
       
        if($condition == 'where'){$this->where = " WHERE {$columns} = {$value} ";}
        //if($condition == 'WHERELIKE'){}

        return $this;
    }
    
    private function treatInsertion(array $data ,string $selector):array|bool
    {
      
        if($selector =='columns'){
            
            $columns= [];
            foreach($data as $colls => $content){
                
                $columns[] = $colls;
                
            }
            return $columns;
        }

        if($selector =='parameters'){
            
            $columns= [];
            foreach($data as $colls => $content){
                
                $columns[] = ":".$colls;
                
            }
            return $columns;
        }

        if($selector =='parameters-update'){
            
            $columns= [];
            foreach($data as $colls => $content){
                
                $columns[] = $colls."= ?";
                
            }
            return $columns;
        }

        if($selector == 'content'){
                $content = [];
            foreach($data as $datas){
                $content [] = $datas;
               
            }
            return $content;
        }
    }

    public function parameters(array $data): QueryBuilder
    {
       $this->data = $data;
       
       $this->fields = implode(',',$this->treatInsertion($data,'columns')); 
       
       $this->param = implode(',',$this->treatInsertion($data,'parameters'));

       $this->paramUpdate = implode(',',$this->treatInsertion($data,'parameters-update'));

       $this->values = implode(',',$this->treatInsertion($data,'content'));


       //recria o array $data separando por key e conteudo 
       $this->paramArray =  explode(',',$this->param);
       
       $this->valuesArray = explode(',', $this->values);
       
       $this->fieldsArray = explode(',',$this->fields);
       
       $this->paramUpdateArray = explode(',',$this->paramUpdate);
       
       return $this;
    }

  
    public function get(string $service): array|bool
    {
        if($service == 'select'){
             try{  
                $select = "SELECT " . implode(",", $this->columns) . " ";
                $table   = "FROM {$this->table} ";
                
                $this->query = $select.$table.$this->where;
                $result = $this->pdo->query($this->query);
                return $result->fetchAll(PDO::FETCH_ASSOC);
                
            }catch(PDOException $e){
                echo 'Error: '. $e->getMessage();
            }
        }
        
        
        if($service == 'insert'){
            try{
                $insert = "INSERT INTO ";
                $table = $this->table;
                $columns = " (".$this->fields.") ";
                $parameters = " VALUES (". $this->param.");";
                
                $result= $this->pdo->prepare($this->query = $insert.$table.$columns.$parameters);

                foreach(array_combine($this->paramArray,$this->valuesArray)as $p => $v){
                    $result->bindValue("{$p}",$v);
                }
                
                $result->execute();
                return true;
             
            }catch(PDOException $e){
                echo 'Error: '. $e->getMessage();
            }
        }

        if($service == 'delete'){
            try{
                $delete = " DELETE FROM ";
                $from = $this->table;
                $columns =  
                $this->pdo->exec( $this->query = $delete.$from.$this->where);

                return true;
            }catch(PDOException $e){
                echo 'Error: '. $e->getMessage();
            }
        }
        
        if($service == 'update'){
           try{
             //update tabela set email = ?, idCliente = ? where idEmail = ?;
            $update = "UPDATE {$this->table} SET ";
            
            //tratano o array e excluindo o ultimo elemento resultado ('elemento1 =', 'elemento2 =')
            $lastKey = array_key_last($this->paramUpdateArray);
            unset($this->paramUpdateArray["{$lastKey}"]);
            
            $set = implode(',',$this->paramUpdateArray);
               
            $result = $this->pdo->prepare($this->query = $update.$set.$this->where.";");

           foreach($this->valuesArray as $i => $values){
               
               $result->bindValue(($i+1),$values);
            }

            $result->execute();

            return true;

           }catch(PDOException $e){
               echo 'Error: '. $e->getMessage();
           }
        }
    
    }
} 