<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Zadania - tablice</title>
</head>
<body>
<?php


// wypisuje zwykla tablice w jednej linii
function pokaz($t)
{
    for ($i = 0; $i < count($t); $i++) {
        echo $t[$i] . " ";
    }
    echo "<br>";
}

// wypisuje tablice z duzymi liczbami (zeby nie bylo zapisu 1.2E+19)
function pokazDuze($t)
{
    for ($i = 0; $i < count($t); $i++) {
        echo number_format($t[$i], 0, "", " ") . " | ";
    }
    echo "<br>";
}

// zamienia wielkie litery na male i odwrotnie
function zamienLitery($t)
{
    $nowa = array();
    for ($i = 0; $i < count($t); $i++) {
        if (ctype_upper($t[$i])) {
            $nowa[$i] = strtolower($t[$i]);
        } else {
            $nowa[$i] = strtoupper($t[$i]);
        }
    }
    return $nowa;
}

//  dane od uzytkownika (z formularza) 
// na starcie sa wartosci domyslne, zeby strona od razu cos pokazywala
$liczbyTekst = "5,3,13,8,3,21,6,9,30,3";
$litery = "AbCdEfGhIj";
$wyraz = "Komputerek";
$a = 20;

if (isset($_POST["liczby"])) {
    $liczbyTekst = $_POST["liczby"];
}
if (isset($_POST["litery"])) {
    $litery = trim($_POST["litery"]);
}
if (isset($_POST["wyraz"])) {
    $wyraz = trim($_POST["wyraz"]);
}
if (isset($_POST["a"])) {
    $a = (int)$_POST["a"];
}

?>
<h1>Zadania - tablice</h1>

<form method="post">
    Liczby do zadania 1 (oddzielone przecinkami):<br>
    <input type="text" name="liczby" size="40" value="<?php echo htmlspecialchars($liczbyTekst); ?>"><br><br>

    10 liter do zadania 2a (bez polskich znaków, bez spacji):<br>
    <input type="text" name="litery" value="<?php echo htmlspecialchars($litery); ?>"><br><br>

    10-literowy wyraz do zadania 2b (bez polskich znaków):<br>
    <input type="text" name="wyraz" value="<?php echo htmlspecialchars($wyraz); ?>"><br><br>

    Liczba "a" do zadania 3e:<br>
    <input type="text" name="a" value="<?php echo htmlspecialchars($a); ?>"><br><br>

    <input type="submit" value="Policz">
</form>

<hr>

<?php

// CZESC A - tab1, tab2, tab3
echo "<h2>Część A - tab1, tab2, tab3</h2>";

$tab1 = array(7, 3, 1, 6, 9, 5, 4, 10, 2, 2);

// komorki numerujemy od 0, wiec "5 komorka" to tab1[5]
echo "Zawartość komórki numer 5: " . $tab1[5] . "<br>";

$tab1[7] = 12;
echo "tab1 po zmianie komórki 7 na 12: ";
pokaz($tab1);

// 2. tab2 - przepisanie tab1
$tab2 = array();
for ($i = 0; $i < count($tab1); $i++) {
    $tab2[$i] = $tab1[$i];
}
echo "tab2 (kopia tab1): ";
pokaz($tab2);

// 3. tab3 - suma tab1 i tab2
$tab3 = array();
for ($i = 0; $i < count($tab1); $i++) {
    $tab3[$i] = $tab1[$i] + $tab2[$i];
}
echo "tab3 (suma tab1 i tab2): ";
pokaz($tab3);

// 4. tab1 do tab2 w odwrotnej kolejnosci
$n = count($tab1);
for ($i = 0; $i < $n; $i++) {
    $tab2[$i] = $tab1[$n - 1 - $i];
}
echo "tab2 po przepisaniu tab1 w odwrotnej kolejności: ";
pokaz($tab2);


// ZADANIE 1
echo "<h2>Zadanie 1</h2>";

// a) wypelnienie tablicy liczbami od uzytkownika
$dane = explode(",", $liczbyTekst);
$tab = array();
foreach ($dane as $x) {
    $tab[] = (int)trim($x);
}
$n = count($tab);
echo "a) Tablica: ";
pokaz($tab);

// b) najmniejszy i najwiekszy
$min = $tab[0];
$max = $tab[0];
for ($i = 1; $i < $n; $i++) {
    if ($tab[$i] < $min) {
        $min = $tab[$i];
    }
    if ($tab[$i] > $max) {
        $max = $tab[$i];
    }
}
echo "b) Najmniejszy: " . $min . ", największy: " . $max . "<br>";

// c) srednia
$suma = 0;
for ($i = 0; $i < $n; $i++) {
    $suma = $suma + $tab[$i];
}
$srednia = $suma / $n;
echo "c) Średnia: " . round($srednia, 2) . "<br>";

// d) ile razy wystepuje cyfra 3 (w zapisie wszystkich liczb)
$trojki = 0;
for ($i = 0; $i < $n; $i++) {
    $trojki = $trojki + substr_count((string)$tab[$i], "3");
}
echo "d) Ilość wystąpień cyfry 3: " . $trojki . "<br>";

// e) sortowanie rosnaco
sort($tab);
echo "e) Posortowana rosnąco: ";
pokaz($tab);

// f) mediana (tablica jest juz posortowana)
if ($n % 2 == 1) {
    $mediana = $tab[floor($n / 2)];
} else {
    $mediana = ($tab[$n / 2 - 1] + $tab[$n / 2]) / 2;
}
echo "f) Mediana: " . $mediana . "<br>";

// g) 3 najmniejsze i 3 najwieksze
if ($n >= 3) {
    echo "g) Trzy najmniejsze: ";
    for ($i = 0; $i < 3; $i++) {
        echo $tab[$i] . " ";
    }
    echo "<br>";
    echo "&nbsp;&nbsp;&nbsp;Trzy największe: ";
    for ($i = 0; $i < 3; $i++) {
        echo $tab[$n - 1 - $i] . " ";
    }
    echo "<br>";
} else {
    echo "g) Za mało liczb (potrzeba minimum 3)<br>";
}

// h) kazdy element do kwadratu
for ($i = 0; $i < $n; $i++) {
    $tab[$i] = $tab[$i] * $tab[$i];
}
echo "h) Po podniesieniu do kwadratu: ";
pokaz($tab);

// i) parzyste i nieparzyste
$parzyste = 0;
$nieparzyste = 0;
for ($i = 0; $i < $n; $i++) {
    if ($tab[$i] % 2 == 0) {
        $parzyste++;
    } else {
        $nieparzyste++;
    }
}
echo "i) Parzystych: " . $parzyste . ", nieparzystych: " . $nieparzyste . "<br>";

// j) podzielne przez 3
$przez3 = 0;
for ($i = 0; $i < $n; $i++) {
    if ($tab[$i] % 3 == 0) {
        $przez3++;
    }
}
echo "j) Liczb podzielnych przez 3: " . $przez3 . "<br>";


// ZADANIE 2
echo "<h2>Zadanie 2</h2>";

// a) 10 liter od uzytkownika
if (strlen($litery) != 10) {
    echo "Podaj dokładnie 10 liter (bez polskich znaków). Użyto domyślnych: AbCdEfGhIj<br>";
    $litery = "AbCdEfGhIj";
}
$tabLitery = str_split($litery);
echo "a) Tablica liter: ";
pokaz($tabLitery);

// b) 10-literowy wyraz
if (strlen($wyraz) != 10) {
    echo "Wyraz musi mieć dokładnie 10 liter (bez polskich znaków). Użyto domyślnego: Komputerek<br>";
    $wyraz = "Komputerek";
}
$tabWyraz = str_split($wyraz);
echo "b) Tablica z wyrazu: ";
pokaz($tabWyraz);

// c) zamiana wielkich liter na male i odwrotnie
$zamienione1 = zamienLitery($tabLitery);
$zamienione2 = zamienLitery($tabWyraz);
echo "c) Tablica liter po zamianie: ";
pokaz($zamienione1);
echo "&nbsp;&nbsp;&nbsp;Tablica z wyrazu po zamianie: ";
pokaz($zamienione2);

// d) losowa kolejnosc
$losowa1 = $tabLitery;
shuffle($losowa1);
$losowa2 = $tabWyraz;
shuffle($losowa2);
echo "d) Litery w losowej kolejności: ";
pokaz($losowa1);
echo "&nbsp;&nbsp;&nbsp;Wyraz w losowej kolejności: ";
pokaz($losowa2);


// ZADANIE 3
echo "<h2>Zadanie 3</h2>";

// tablica 100 losowych liczb (od 1 do 50, zeby cos sie powtarzalo)
$A = array();
for ($i = 0; $i < 100; $i++) {
    $A[$i] = rand(1, 50);
}
echo "Tablica A: ";
pokaz($A);

// a) najwieksza i ile razy wystepuje
$maxA = $A[0];
for ($i = 1; $i < 100; $i++) {
    if ($A[$i] > $maxA) {
        $maxA = $A[$i];
    }
}
$ileMax = 0;
for ($i = 0; $i < 100; $i++) {
    if ($A[$i] == $maxA) {
        $ileMax++;
    }
}
echo "<br>a) Największa liczba: " . $maxA . ", występuje " . $ileMax . " razy<br>";

// b) liczby nieparzyste
echo "<br>b) Liczby nieparzyste: ";
for ($i = 0; $i < 100; $i++) {
    if ($A[$i] % 2 != 0) {
        echo $A[$i] . " ";
    }
}
echo "<br>";

// c) liczby z nieparzystych indeksow
echo "<br>c) Liczby z komórek o nieparzystych indeksach: ";
for ($i = 1; $i < 100; $i = $i + 2) {
    echo $A[$i] . " ";
}
echo "<br>";

// d) liczby z przedzialu <5, 15)
$ilePrzedzial = 0;
$przedzial = array();
for ($i = 0; $i < 100; $i++) {
    if ($A[$i] >= 5 && $A[$i] < 15) {
        $ilePrzedzial++;
        $przedzial[] = $A[$i];
    }
}
echo "<br>d) Liczb z przedziału <5, 15): " . $ilePrzedzial . "<br>";
echo "&nbsp;&nbsp;&nbsp;Są to: ";
pokaz($przedzial);

// e) element najblizszy liczbie a
$najblizszy = $A[0];
$roznica = abs($A[0] - $a);
for ($i = 1; $i < 100; $i++) {
    if (abs($A[$i] - $a) < $roznica) {
        $roznica = abs($A[$i] - $a);
        $najblizszy = $A[$i];
    }
}
echo "<br>e) Dla a = " . $a . " najbliższy element to: " . $najblizszy . "<br>";

// f) poprzednik i nastepnik najmniejszej wartosci
$indMin = 0;
for ($i = 1; $i < 100; $i++) {
    if ($A[$i] < $A[$indMin]) {
        $indMin = $i;
    }
}
echo "<br>f) Najmniejsza wartość: " . $A[$indMin] . " (indeks " . $indMin . ")<br>";
if ($indMin > 0) {
    echo "&nbsp;&nbsp;&nbsp;Poprzednik: " . $A[$indMin - 1] . "<br>";
} else {
    echo "&nbsp;&nbsp;&nbsp;Poprzednik: brak (minimum jest na początku tablicy)<br>";
}
if ($indMin < 99) {
    echo "&nbsp;&nbsp;&nbsp;Następnik: " . $A[$indMin + 1] . "<br>";
} else {
    echo "&nbsp;&nbsp;&nbsp;Następnik: brak (minimum jest na końcu tablicy)<br>";
}

// g) nowa tablica z elementami > 10
$C = array();
for ($i = 0; $i < 100; $i++) {
    if ($A[$i] > 10) {
        $C[] = $A[$i];
    }
}
echo "<br>g) Nowa tablica z liczbami większymi od 10, rozmiar: " . count($C) . "<br>";
pokaz($C);

// h) tablica B - sumy czesciowe
$B = array();
$B[0] = $A[0];
for ($i = 1; $i < 100; $i++) {
    $B[$i] = $B[$i - 1] + $A[$i];
}
echo "<br>h) Tablica B (sumy częściowe): ";
pokaz($B);

// i) sortowanie malejaco
rsort($A);
echo "<br>i) Tablica A posortowana malejąco: ";
pokaz($A);

// j) liczby wystepujace co najmniej 3 razy
echo "<br>j) Liczby występujące co najmniej 3 razy:<br>";
for ($v = 1; $v <= 50; $v++) {
    $ile = 0;
    for ($i = 0; $i < 100; $i++) {
        if ($A[$i] == $v) {
            $ile++;
        }
    }
    if ($ile >= 3) {
        echo $v . " (" . $ile . " razy)<br>";
    }
}


// ZADANIE 4
echo "<h2>Zadanie 4</h2>";

// pusta tablica 100 elementow (same zera)
$T = array();
for ($i = 0; $i < 100; $i++) {
    $T[$i] = 0;
}

// a) ciag Fibonacciego
$T[0] = 1;
$T[1] = 1;
for ($i = 2; $i < 100; $i++) {
    $T[$i] = $T[$i - 1] + $T[$i - 2];
}
echo "a) Fibonacci:<br>";
pokazDuze($T);

// b) potegi liczby 2
$T[0] = 1;
for ($i = 1; $i < 100; $i++) {
    $T[$i] = $T[$i - 1] * 2;
}
echo "<br>b) Potęgi liczby 2:<br>";
pokazDuze($T);

// c) 3, 6, 9, 12, ...
for ($i = 0; $i < 100; $i++) {
    $T[$i] = 3 * ($i + 1);
}
echo "<br>c) Ciąg 3, 6, 9, 12, ...:<br>";
pokaz($T);

// d) 2, 4, 8, 16, 32, ...
$T[0] = 2;
for ($i = 1; $i < 100; $i++) {
    $T[$i] = $T[$i - 1] * 2;
}
echo "<br>d) Ciąg 2, 4, 8, 16, 32, ...:<br>";
pokazDuze($T);

?>
</body>
</html>
