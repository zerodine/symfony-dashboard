<?php
/**
 * Created by PhpStorm.
 * User: tspycher
 * Date: 21/06/14
 * Time: 17:30
 */

namespace Zerodine\DashboardBundle\Boxes\Sources;


class FinanceSource implements SourceInterface {

    protected $client;

    function __construct($client) {
        $this->client = $client;
    }

    public function getMacroname()
    {
        return "finance";
    }

    public function getTitle()
    {
        return "Finance";
    }

    public function getValue()
    {
        return $this->bankSaldo();
    }

    protected function bankSaldo() {
        $response = $this->client->get('reports/BalanceSheet')->send();
        return doubleval($response->xml()->Reports->Report->Rows->Row[2]->Rows->Row[1]->Cells->Cell[1]->Value);
    }
}