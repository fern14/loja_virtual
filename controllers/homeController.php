<?php
class homeController extends controller
{

    private $user;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $dados = array();

        $products = new Products();

        $currentPage = 1;
        $limit = 3;
        $offset = 0;

        if (isset($_GET['p']) && !empty($_GET['p'])) {
            $currentPage = $_GET['p'];
        }

        $offset = ($currentPage * $limit) - $limit;

        $dados['list'] = $products->getList($offset, $limit);
        // saber total items
        $dados['totalItems'] = $products->getTotal();
        // pegando o numero de paginas e arredondando
        $dados['numberOfPages'] = ceil(($dados['totalItems'] / $limit));
        // pagina inicial
        $dados['currentPage'] = $currentPage;

        $this->loadTemplate('home', $dados);
    }
}
