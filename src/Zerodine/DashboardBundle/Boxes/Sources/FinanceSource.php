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
    protected $type;
    protected $goal = 0;

    const FINANCE_GOAL = 'goal';
    const FINANCE_ACCOUNT = 'account';

    function __construct($client, $type = FinanceSource::FINANCE_GOAL) {
        $this->client = $client;
        $this->type = $type;
    }

    /**
     * @param int $goal
     */
    public function setGoal($goal)
    {
        $this->goal = $goal;
        return $this;
    }

    /**
     * @return int
     */
    public function getGoal()
    {
        return $this->goal;
    }

    public function getGoalPercent() {
        return 100 / $this->goal * $this->getValue();
    }
    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
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