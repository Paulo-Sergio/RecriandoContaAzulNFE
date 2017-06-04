<?php

class SalesController extends Controller {

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

        $data['statuser'] = array(
            '0' => 'Aguardando Pagamento',
            '1' => 'Pago',
            '2' => 'Cancelado'
        );

        if ($this->user->hasPermission('sales_view')) {
            $s = new Sales();
            $offset = 0;

            $data['sales_list'] = $s->getList($offset, $this->user->getCompany());

            $this->loadTemplate('sales', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

    public function add() {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);
        if ($this->user->hasPermission('sales_view')) {
            $s = new Sales();

            if (isset($_POST['client_id']) && !empty($_POST['client_id'])) {
                $clientId = addslashes($_POST['client_id']);
                $status = addslashes($_POST['status']);
                $productsQuant = $_POST['quant'];

                $s->add($this->user->getCompany(), $clientId, $this->user->getId(), $productsQuant, $status);
                header("Location: " . BASE_URL . "/sales");
                exit();
            }

            $this->loadTemplate('sales_add', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

    public function edit($id) {
        // informações para o template
        $data['info_template'] = Utilities::loadTemplateBaseInfo($this->user);

        $data['statuser'] = array(
            '0' => 'Aguardando Pagamento',
            '1' => 'Pago',
            '2' => 'Cancelado'
        );

        if ($this->user->hasPermission('sales_view')) {
            $s = new Sales();
            $data['sales_info'] = $s->getInfo($id, $this->user->getCompany());
            $data['permission_edit'] = $this->user->hasPermission('sales_edit');

            if (isset($_POST['status']) && $data['permission_edit']) {
                $status = addslashes($_POST['status']);

                $s->changeStatus($id, $status, $this->user->getCompany());
                header("Location: " . BASE_URL . "/sales");
                exit();
            }

            $this->loadTemplate('sales_edit', $data);
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

    public function generate_nfe($idSale) {
        $company = new Companies($this->user->getCompany());
        $sales = new Sales();
        $clients = new Clients();

        $cNF = $company->getNextNFE();

        $salesInfo = $sales->getAllInfo($idSale, $this->user->getCompany());
        $clientInfo = $clients->getInfo($salesInfo['info']['id_client'], $this->user->getCompany());

        /* Pegando infos inicial da fatura */
        $fatinfo = array(
            'nfat' => $idSale,
            'vOrig' => number_format($salesInfo['info']['total_price'], 2), // formato para a nota 100.00
            'vDesc' => '', // sem desconto
            'modFrete' => '9' // sem frete
        );

        /* Pegando infos do cliente */
        $dest = array(
            'cpf' => $clientInfo['cpf'],
            'cnpj' => $clientInfo['cnpj'],
            'idestrangeiro' => $clientInfo['foreignid'],
            'nome' => $clientInfo['name'],
            'email' => $clientInfo['email'],
            'iedest' => $clientInfo['iedest'],
            'ie' => $clientInfo['ie'],
            'isuf' => $clientInfo['isuf'],
            'im' => $clientInfo['im'],
            'end' => array(
                'logradouro' => $clientInfo['address'],
                'numero' => $clientInfo['address_number'],
                'complemento' => $clientInfo['address2'],
                'bairro' => $clientInfo['address_neighb'],
                'mu' => $clientInfo['address_city'],
                'uf' => $clientInfo['address_state'],
                'cep' => $clientInfo['address_zipcode'],
                'pais' => $clientInfo['address_country'],
                'fone' => $clientInfo['phone'],
                'cmu' => $clientInfo['address_citycode'],
                'cpais' => $clientInfo['address_countrycode']
            )
        );

        /* Pegando infos dos produtos */
        $prods = array();
        foreach ($salesInfo['products'] as $prod) {
            $sale_price = number_format($prod['sale_price'], 2);
            $prods[] = array(
                'cProd' => $prod['id_product'],
                'cEAN' => $prod['c']['cEAN'],
                'xProd' => $prod['c']['name'],
                'NCM' => $prod['c']['NCM'],
                'EXTIPI' => $prod['c']['EXTIPI'],
                'CFOP' => $prod['c']['CFOP'],
                'uCom' => $prod['c']['uCom'],
                'vUnCom' => $sale_price,
                'cEANTrib' => $prod['c']['cEANTrib'],
                'uTrib' => $prod['c']['uTrib'],
                'vUnTrib' => $sale_price,
                'vFrete' => $prod['c']['vFrete'],
                'vSeg' => $prod['c']['vSeg'],
                'vDesc' => $prod['c']['vDesc'],
                'vOutro' => $prod['c']['vOutro'],
                'indTot' => $prod['c']['indTot'],
                'xPed' => $prod['c']['xPed'],
                'nItemPed' => $prod['c']['nItemPed'],
                'nFCI' => $prod['c']['nFCI'],
                'cst' => $prod['c']['cst'],
                'pPIS' => number_format($prod['c']['pPIS'], 2),
                'pCOFINS' => number_format($prod['c']['pCOFINS'], 2),
                'csosn' => $prod['c']['csosn'],
                'pICMS' => $prod['c']['pICMS'], // 18
                'orig' => $prod['c']['orig'],
                'modBC' => $prod['c']['modBC'],
                'vICMSDeson' => $prod['c']['vICMSDeson'],
                'pRedBC' => $prod['c']['pRedBC'],
                'modBCST' => $prod['c']['modBCST'],
                'pMVAST' => $prod['c']['pMVAST'],
                'pRedBCST' => $prod['c']['pRedBCST'],
                'vBCSTRet' => $prod['c']['vBCSTRet'],
                'vICMSSTRet' => $prod['c']['vICMSSTRet'],
                'qBCProd' => $prod['c']['qBCProd'],
                'vAliqProd' => $prod['c']['vAliqProd'],
                'qCom' => $prod['quant'],
                'vProd' => ($prod['quant'] * $sale_price),
                'vBC' => ($prod['quant'] * $sale_price),
                'qTrib' => $prod['quant']
            );
        }

        $nfe = new Nfe();
        $chave = $nfe->emitirNFE($cNF, $dest, $prods, $fatinfo);

        if (!empty($chave)) {
            $company->setNFE($cNF, $this->user->getCompany());
            $sales->setNFEKey($chave, $idSale);

            header("Location: " . BASE_URL . "/sales/view_nfe/" . $chave);
        }
    }

    public function view_nfe($nfeKey) {
        header("Content-Type: application/pdf");
        readfile("nfe/files/nfe/danfe/" . $nfeKey . ".pdf");
    }

}
