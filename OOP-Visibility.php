<?php
declare(strict_types=1);

class BankAccount {
    private string $banknummer;
    protected float $saldo;

    public function __construct(string $banknummer, float $saldo = 0.0) {
        $this->banknummer = $banknummer;
        $this->saldo = $saldo;
    }

    public function getSaldo(): float {
        return $this->saldo;
    }

    protected function setSaldo(float $saldo): void {
        $this->saldo = $saldo;
    }

    public function toevoegen(float $bedrag): void {
        $this->saldo += $bedrag;
    }

    public function onttrekken(float $bedrag): void {
        $nieuwSaldo = $this->saldo - $bedrag;
        if ($nieuwSaldo >= 0) {
            $this->saldo = $nieuwSaldo;
        } else {
            echo "Saldo is niet toereikend voor deze transactie.";
        }
    }
}

declare(strict_types=1);

class BankAccountPlus extends BankAccount {
    private float $boeterentePercentage;

    public function __construct(string $banknummer, float $boeterentePercentage, float $saldo = 0.0) {
        parent::__construct($banknummer, $saldo);
        $this->boeterentePercentage = $boeterentePercentage;
    }

    public function getBoeterentePercentage(): float {
        return $this->boeterentePercentage;
    }

    public function setBoeterentePercentage(float $boeterentePercentage): void {
        $this->boeterentePercentage = $boeterentePercentage;
    }

    public function berekenBoete(float $bedrag): float {
        return $bedrag * ($this->boeterentePercentage / 100);
    }

    public function toevoegen(float $bedrag): void {
        $this->saldo += $bedrag;
        $boete = $this->berekenBoete($bedrag);
        echo "Boetebedrag: $boete";
    }

    public function onttrekken(float $bedrag): void {
        $this->saldo -= $bedrag;
        $boete = $this->berekenBoete($bedrag);
        echo "Boetebedrag: $boete";
    }
}


$bankAccountPlus = new BankAccountPlus('NL98ZYXW765432109', 2.0, 100.0);
echo 'Saldo: ' . $bankAccountPlus->getSaldo() . "\\n";
$bankAccountPlus->toevoegen(50.0);
echo 'Saldo na toevoeging: ' . $bankAccountPlus->getSaldo() . "\\n";
$bankAccountPlus->onttrekken(200.0);
echo 'Saldo na onttrekking: ' . $bankAccountPlus->getSaldo() . "\\n";


?>