# MFSG_CMS
Content management system created for the subject of laboratories "Content management systems".

<b>Instalacja systemu - (przykład z użyciem programu XAMPP)</b>
<ol>
    <li>Wypakuj pliki systemu do folderu htdocs w folderze XAMPP</li>
    <li>Potrzebny jest zainstalowany composer. Jeśli go nie masz, możesz go pobrać stąd: <a href="https://getcomposer.org/">https://getcomposer.org/</a></li>
    <li>
        Pobieranie pakietów przy użyciu composera:
        <ul>
            <li>Pierwsze pobieranie paczek dla projektu należy wykonać wpisując komendę:
                 <pre>composer install</pre>
            </li>
            <li>Jeśli tylko aktualizujemy pakiety:
                 <pre>composer update</pre>
            </li>
        </ul>
    </li>
    <li>Stwórz bazę danych `mfsg_cms` z kodowaniem `utf8_general_ci`</li>
    <li>Edytuj dane dostępowe do bazy danych w pliku `/config/db.php`</li>
    <li>Wykonaj migrację dodającą dane do Twojego systemu wpisując:
        <pre>./yii migrate</pre>
    </li>
</ol>

