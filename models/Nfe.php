<?php

class Nfe extends Model {

    public function emitirNFE() {
        $nfe = new NFePHP\NFe\MakeNFe();
        $nfeTools = new NFePHP\NFe\ToolsNFe("nfe/files/config.json");

        //Dados da NFe - infNFe
        $cUF = $nfeTools->aConfig['cUF']; //codigo numerico do estado
        $natOp = 'Venda de Produto'; //natureza da operação
        $indPag = '0'; //0=Pagamento à vista; 1=Pagamento a prazo; 2=Outros
        $mod = '55'; //modelo da NFe 55 ou 65 essa última NFCe
        $serie = '1'; //serie da NFe
        $nNF = $cNF; // numero da NFe
        $dhEmi = date("Y-m-d\TH:i:sP"); // Data de emissão
        $dhSaiEnt = date("Y-m-d\TH:i:sP"); //Data de entrada/saida
        $tpNF = '1'; // 0=entrada; 1=saida
        $idDest = '1'; //1=Operação interna; 2=Operação interestadual; 3=Operação com exterior.
        $cMunFG = $nfeTools->aConfig['cMun']; // Código do Município
        $tpImp = '1'; //0=Sem geração de DANFE; 1=DANFE normal, Retrato; 2=DANFE normal, Paisagem; 3=DANFE Simplificado; 4=DANFE NFC-e; 5=DANFE NFC-e em mensagem eletrônica
        $tpEmis = '1'; //1=Emissão normal (não em contingência);
        //2=Contingência FS-IA, com impressão do DANFE em formulário de segurança;
        //3=Contingência SCAN (Sistema de Contingência do Ambiente Nacional);
        //4=Contingência DPEC (Declaração Prévia da Emissão em Contingência);
        //5=Contingência FS-DA, com impressão do DANFE em formulário de segurança;
        //6=Contingência SVC-AN (SEFAZ Virtual de Contingência do AN);
        //7=Contingência SVC-RS (SEFAZ Virtual de Contingência do RS);
        //9=Contingência off-line da NFC-e (as demais opções de contingência são válidas também para a NFC-e);
        //Nota: Para a NFC-e somente estão disponíveis e são válidas as opções de contingência 5 e 9.
        $tpAmb = $nfeTools->aConfig['tpAmb']; //1=Produção; 2=Homologação
        $finNFe = '1'; //1=NF-e normal; 2=NF-e complementar; 3=NF-e de ajuste; 4=Devolução/Retorno.
        $indFinal = '0'; //0=Normal; 1=Consumidor final;
        $indPres = '2'; //0=Não se aplica (por exemplo, Nota Fiscal complementar ou de ajuste);
        //1=Operação presencial;
        //2=Operação não presencial, pela Internet;
        //3=Operação não presencial, Teleatendimento;
        //4=NFC-e em operação com entrega a domicílio;
        //9=Operação não presencial, outros.
        $procEmi = '0'; //0=Emissão de NF-e com aplicativo do contribuinte;
        //1=Emissão de NF-e avulsa pelo Fisco;
        //2=Emissão de NF-e avulsa, pelo contribuinte com seu certificado digital, através do site do Fisco;
        //3=Emissão NF-e pelo contribuinte com aplicativo fornecido pelo Fisco.
        $verProc = $nfeTools->aConfig['vApp']; //versão do aplicativo emissor
        $dhCont = ''; //entrada em contingência AAAA-MM-DDThh:mm:ssTZD
        $xJust = ''; //Justificativa da entrada em contingência
        $cnpj = $nfeTools->aConfig['cnpj']; // CNPJ do emitente
    }

}
