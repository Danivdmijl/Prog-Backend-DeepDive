<?php
SELECT COUNT(DISTINCT department)
FROM employees;

SELECT location_id, COUNT(DISTINCT department_id) AS num_departments
FROM departments
GROUP BY location_id;

// Schakel foutmeldingen uit op het scherm
ini_set('display_errors', 0);
// Stel het logbestand in voor foutmeldingen
ini_set('log_errors', 1);
ini_set('error_log', 'application_errors.log');


function keer_om($string) {
    return strrev($string);
}


$input = "Invoer string";
$output = keer_om($input);
echo $output;  // Geeft "gnirts reovnI" weer


$input = "Een lange tekst";
$output = keer_om($input);
echo $output;  // Geeft "tsket egnal neE" weer

function reverse_case($string) {
    return strtr($string, 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz', 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
}

$input = "Fijne verjaardag";
$output = reverse_case($input);
echo $output;  // Geeft "fIJNE VERJAARDAG" weer

$input = "Alles omgEDRaaid";
$output = reverse_case($input);
echo $output;  // Geeft "aLLES OMGed

function check_type($input) {
    if (is_string($input)) {
        echo "Het is een string.";
    } elseif (is_array($input)) {
        echo "Het is een array.";
    } else {
        echo "Het is geen string of array.";
    }
}


$input = "Dit is een string";
check_type($input);  // Geeft "Het is een string." weer

$input = [1, 2, 3];
check_type($input);  // Geeft "Het is een array." weer

$input = 123;
check_type($input);  // Geeft "Het is geen string of array." weer

function reverse_array($array) {
    return array_reverse($array);
}

$array = [1, 2, 3, 4, 5];
$reversed = reverse_array($array);
print_r($reversed);  // Geeft [5, 4, 3, 2, 1] weer

function reverse_input($input) {
    if (is_string($input)) {
        return strrev($input);
    } elseif (is_array($input)) {
        return array_reverse($input);
    } else {
        return "Ongeldige invoer.";
    }
}

$input = "Dit is een string";
$reversed = reverse_input($input);
echo $reversed;  // Geeft "gnirts nee siT" weer

$input = [1, 2, 3, 4, 5];
$reversed = reverse_input($input);
print_r($reversed);  // Geeft [5, 4, 3, 2, 1] weer

$input = 123;
$reversed = reverse_input($input);
echo $reversed;  // Geeft "Ongeldige invoer." weer

$voornamen = ["Anna", "Bas", "Chris", "David", "Emma", "Fleur", "Gijs", "Hannah", "Iris", "Jasper"];

function zoek_naam($naam, $voornamen) {
    $gevonden_positie = array_search(strtolower($naam), array_map('strtolower', $voornamen));
    
    if ($gevonden_positie !== false) {
        return $gevonden_positie;
    } else {
        return -1;
    }
}

$voornamen = ["Anna", "Bas", "Chris", "David", "Emma", "Fleur", "Gijs", "Hannah", "Iris", "Jasper"];

$naam = "David";
$positie = zoek_naam($naam, $voornamen);
echo "Positie van $naam in de array: $positie";  // Geeft "Positie van David in de array: 3" weer

$naam = "Emma";
$positie = zoek_naam($naam, $voornamen);
echo "Positie van $naam in de array: $positie";  // Geeft "Positie van Emma in de array: 4" weer

$naam = "OpenAI";
$positie = zoek_naam($naam, $voornamen);
echo "Positie van $naam in de array: $positie";  // Geeft "Positie van OpenAI in de array: -1" weer

class Bankrekening {
    private $banknummer;
    private $saldo;

    public function __construct($banknummer, $saldo = 0) {
        $this->banknummer = $banknummer;
        $this->saldo = $saldo;
    }

    public function storten($bedrag) {
        $this->saldo += $bedrag;
    }

    public function opnemen($bedrag) {
        if ($bedrag <= $this->saldo) {
            $this->saldo -= $bedrag;
            return true;
        } else {
            return false;
        }
    }

    public function getSaldo() {
        return $this->saldo;
    }
}

// Maak een nieuwe bankrekening
$rekening = new Bankrekening("NL12ABCD34567890", 1000);

// Stort geld op de rekening
$rekening->storten(500);

// Haal geld van de rekening af
if ($rekening->opnemen(800)) {
    echo "Opname succesvol. Saldo: " . $rekening->getSaldo();
} else {
    echo "Onvoldoende saldo voor opname. Saldo: " . $rekening->getSaldo();
}

class BankrekeningPlus extends Bankrekening {
    private $limiet = -1000;

    public function opnemen($bedrag) {
        $saldoMetLimiet = $this->getSaldo() - $bedrag;
        if ($saldoMetLimiet >= $this->limiet) {
            $this->saldo -= $bedrag;
            return true;
        } else {
            return false;
        }
    }

    public function berekenBoete() {
        $boeteBedrag = 0;
        if ($this->saldo < 0) {
            $boeteBedrag = abs($this->saldo) * 0.05;
        }
        return $boeteBedrag;
    }

    public function toonBoeteSaldoDatum() {
        $boete = $this->berekenBoete();
        $saldo = $this->getSaldo();
        $datumTijd = date("Y-m-d H:i:s");
        echo "Boete bedrag: $boete EUR\n";
        echo "Saldo: $saldo EUR\n";
        echo "Datum en tijd van berekening: $datumTijd\n";
    }
}

// Maak een nieuwe BankrekeningPlus
$rekeningPlus = new BankrekeningPlus("NL12ABCD34567890", 1000);

// Neem geld op
if ($rekeningPlus->opnemen(2000)) {
    echo "Opname succesvol. Saldo: " . $rekeningPlus->getSaldo() . " EUR\n";
} else {
    echo "Opname mislukt. Onvoldoende saldo of overschrijding limiet.\n";
}

// Bereken en toon boete, saldo en datum
$rekeningPlus->toonBoeteSaldoDatum();

declare(strict_types=1);

class Product {
    public function __construct(private string $naam, private string $beschrijving, private int $prijs) {}

    public function setName(string $naam) {
        $this->naam = $naam;
    }

    public function getName() : string {
        return $this->naam;
    }
}

?>