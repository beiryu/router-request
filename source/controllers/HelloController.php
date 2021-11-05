<?php 

namespace Fresher\Source\Controllers;

class HelloController {

    protected $request = null;
    protected $params = null;
    public $action = null;
    public function __construct($request, $params, $action)
    {
        $this->request = $request;
        $this->params = $params;
        $this->action = $action;

    }
    public function execute()
    {
        $functionName = $this->action;
        $this->$functionName();

    }
    public function index ()
    {
        echo 'hello hello';
    }

    public function store()
    {
        echo 'hello store';
        print_r($this->request->getJson());
        print_r($this->request->getAllParams());
        print_r($this->params);
        print_r($this->request->getParam('name'));


    }

    public function show()
    {
        echo 'hello show';
    }

    public function update()
    {
        echo 'hello update';
        print_r($this->request->getJson());
        print_r($this->request->getAllParams());
        print_r($this->params);

    }

    public function destroy()
    {
        echo 'hello destroy';
    }
}