<?php 
namespace Fresher\Source\Controllers;

class GoodbyeController {

    public function execute($action)
    {
        $this->$action();
    }

    public function index ()
    {
        echo 'goodbye index';
    }

    public function store()
    {
        echo 'hello store';
    }

    public function show()
    {
        echo 'hello show';
    }

    public function update()
    {
        echo 'hello update';
    }

    public function destroy()
    {
        echo 'hello destroy';
    }
}