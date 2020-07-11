<?php namespace App\Controllers;
 
// Item Controller
// Author: Sistiandy <sistiandy.syahbana@gmail.com>

// This item controller act as an item
// Create, list, view item

// This project layout is a little bit messy, but this behaviour comes
// from the ancestor and this inherited from ancient world.

use App\Models\ItemModel;

class Item extends BaseController
{
    protected $itemModel;
    public function __construct()
    {
        $this->itemModel = new ItemModel();
    }

    public function index()
    {
        $data['title'] = "Item";
        $data['items'] = $this->itemModel->findAll();
        return view('item/list', $data);
    }
 
}