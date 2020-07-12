<?php

namespace App\Controllers;

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

    public function add()
    {
        $request = service('request');
        if ($request->getMethod() == 'post') {
            if (!$this->validate([
                'item_name' => 'required|is_unique[items.item_name]',
                'item_purchase_price'  => 'required',
                'item_selling_price'  => 'required',
                'item_stock'  => 'required'
            ])) {
                session()->setFlashdata('failed', 'Nama barang sudah ada.');

                return redirect()->to('/item');
            } else {
                $this->itemModel->save([
                    'item_name' => $this->request->getVar('item_name'),
                    'item_purchase_price' => $this->request->getVar('item_purchase_price'),
                    'item_selling_price' => $this->request->getVar('item_selling_price'),
                    'item_stock' => $this->request->getVar('item_stock'),
                ]);
                session()->setFlashdata('success', 'Data berhasil ditambahkan.');

                return redirect()->to('/item');
            }
        } else {
            return redirect()->to('/item');
        }
    }

    public function delete()
    {

        $request = service('request');
        if ($request->getMethod() == 'post') {
        $id = $this->request->getVar('id');

        $this->itemModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus.');
        }

        return redirect()->to('/item');
    }
}
