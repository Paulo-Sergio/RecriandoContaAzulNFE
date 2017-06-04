<?php

class ReportController extends Controller {

    private $user;

    public function __construct() {
        parent::__construct();

        $this->user = new Users();
        if (!$this->user->isLogged()) {
            header("Location: " . BASE_URL . "/login");
            exit();
        }
        
        $this->user->setLoggedUser();
    }

    public function index() {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        if ($this->user->hasPermission('report_view')) {
            $this->loadTemplate('report', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

    public function sales() {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        
        $data['statuser'] = array(
            '0' => 'Aguardando Pagamento',
            '1' => 'Pago',
            '2' => 'Cancelado'
        );

        if ($this->user->hasPermission('report_view')) {
            $this->loadTemplate('report_sales', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

    public function sales_pdf() {
        $data['statuser'] = array(
            '0' => 'Aguardando Pagamento',
            '1' => 'Pago',
            '2' => 'Cancelado'
        );

        if ($this->user->hasPermission('report_view')) {
            $client_name = addslashes($_GET['client_name']);
            $period1 = addslashes($_GET['period1']);
            $period2 = addslashes($_GET['period2']);
            $status = addslashes($_GET['status']);
            $order = addslashes($_GET['order']);

            $s = new Sales();
            $data['sales_list'] = $s->getSalesFiltered($client_name, $period1, $period2, $status, $order, $this->user->getCompany());

            $data['filters'] = $_GET;

            ob_start(); // iniciando buffer [armazenando na memoria o que era pra ser carregado na view]
            $this->loadView('report_sales_pdf', $data);
            $html = ob_get_contents(); // pegando tudo armazenado no buffer e colocando na variavel $html
            ob_end_clean(); // zerando a memoria quanto a este processo
            
            // escrevendo todo html para o pdf e gerando um saída
            $mpdf = new mPDF();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }
    
    public function inventory() {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        
        if ($this->user->hasPermission('report_view')) {
            $this->loadTemplate('report_inventory', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }
    
    public function inventory_pdf() {
        if ($this->user->hasPermission('report_view')) {
            // não vai receber nada de filtro por enquanto
            $i = new Inventory();
            $data['inventory_list'] = $i->getInventoryFiltered($this->user->getCompany());

            $data['filters'] = $_GET;

            // carregando biblioteca para geração do pdf
            $this->loadLibrary('mpdf60/mpdf');

            ob_start(); // iniciando buffer [armazenando na memoria o que era pra ser carregado na view]
            $this->loadView('report_inventory_pdf', $data);
            $html = ob_get_contents(); // pegando tudo armazenado no buffer e colocando na variavel $html
            ob_end_clean(); // zerando a memoria quanto a este processo
            
            // escrevendo todo html para o pdf e gerando um saída
            $mpdf = new mPDF();
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

}
