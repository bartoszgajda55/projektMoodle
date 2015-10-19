<h1>Główne treści</h1><hr>
<div class="col-md-4">
    <ul class="nav nav-pills nav-stacked">
        <?php
        standardowy_przycisk("?v=tresc/test_menu_z_lewej/glowne&prawa=tresc/test_menu_z_lewej/plik1", "Test 1");
        standardowy_przycisk("?v=tresc/test_menu_z_lewej/glowne&prawa=tresc/test_menu_z_lewej/plik2", "Dwa");
        standardowy_przycisk("?v=tresc/test_menu_z_lewej/glowne&prawa=tresc/test_menu_z_lewej/plik3", "Trzy");     
        ?>
       <!--- <li role="presentation"><a href="?v=tresc/test_menu_z_lewej/glowne&prawa=tresc/test_menu_z_lewej/plik3">Trzy</a></li> --->
    </ul>
</div>
<div class="col-md-8">
    
    <?php 
    dolacz_plik("prawa", "tresc/test_menu_z_lewej/plik1"); 
    ?>
</div>