<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class ItemModel extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'item_id';
    protected $allowedFields = ['item_name', 'item_image', 'item_purchase_price', 'item_selling_price', 'item_stock'];
 
    public function saveItem($data){
        $query = $this->db->table('items')->insert($data);
        return $query;
    }
 
    public function updateItem($data, $id)
    {
        $query = $this->db->table('items')->update($data, array('item_id' => $id));
        return $query;
    }
 
    public function deleteItem($id)
    {
        $query = $this->db->table('items')->delete(array('item_id' => $id));
        return $query;
    } 
 
   
}