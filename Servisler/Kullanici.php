<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    function getKullaniciByEmail($email){
        GLOBAL $db;
        $sorgu_dizgesi = "
            SELECT 
                *
            FROM kullanici
            WHERE kullanici.email = ?
        ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sorgu->execute([$email]);
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        $sonuc = count($sonuc) != 0 ? $sonuc[0] : false;
        return $sonuc;
    }

    function telefon_duzelt($phone){
        $phone = str_replace(" ", "", $phone);
        $phone = str_replace("+90", "", $phone);
        if(substr($phone, 0, 1) == "0"){
            $phone = substr($phone, 1);
        }
        return $phone;
    }

    function getKullaniciByPhone($phone){
        GLOBAL $db;
        $phone = telefon_duzelt($phone);
        $sorgu_dizgesi = "
            SELECT 
                *
            FROM kullanici
            WHERE kullanici.telefon = ?
        ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sorgu->execute([$phone]);
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        $sonuc = count($sonuc) != 0 ? $sonuc[0] : false;
        return $sonuc;
    }

    function getKullaniciByID($id){
        GLOBAL $db;
        $sorgu_dizgesi = "
            SELECT 
                isim,
                soyisim,
                email,
                profil_resmi,
                son_gorulme
            FROM kullanici
            WHERE kullanici.id = ?
        ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sorgu->execute([$id]);
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        $sonuc = count($sonuc) != 0 ? $sonuc[0] : false;
        return $sonuc;
    }

    function getKullaniciSessionByID($id){
        GLOBAL $db;
        $sorgu_dizgesi = "
            SELECT 
                *
            FROM kullanici
            WHERE kullanici.id = ?
        ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sorgu->execute([$id]);
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        $sonuc = count($sonuc) != 0 ? $sonuc[0] : false;
        return $sonuc;
    }

    function getKullaniciByParolaYenilemeKodu($parola_yenileme_kodu){
        GLOBAL $db;
        $sorgu_dizgesi = "
            SELECT 
                *
            FROM kullanici
            WHERE kullanici.parola_yenileme_kodu = ?
        ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sorgu->execute([$parola_yenileme_kodu]);
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        $sonuc = count($sonuc) != 0 ? $sonuc[0] : false;
        return $sonuc;
    }


    function kullanici_goruldu($kullanici_id){
        GLOBAL $db;
        $sorgu_dizgesi = "
            UPDATE kullanici SET
                son_gorulme = NOW()
            WHERE id = ?
        ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sonuc = $sorgu->execute([$kullanici_id]);
        return $sonuc;
    }

    function profilResmiYukle($kullanici_id, $profil_resmi){
        GLOBAL $db;
        $sorgu_dizgesi = "
            UPDATE kullanici SET
                profil_resmi = ? 
            WHERE id = ?
        ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sonuc = $sorgu->execute([$profil_resmi, $kullanici_id]);
        return $sonuc;
    }

    function parola_guncelle($parola, $kullanici_id){
        GLOBAL $db;
        $sorgu_dizgesi = "
            UPDATE kullanici SET
                parola = ? 
            WHERE id = ?
        ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sonuc = $sorgu->execute([md5($parola), $kullanici_id]);
        return $sonuc;
    }


    function getRoller(){
        GLOBAL $db;
        $sorgu_dizgesi = "
            SELECT * FROM rol
        ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sorgu->execute();
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        $roller = [];
        foreach($sonuc as $rol){
            array_push($roller, $rol['rol_adi']);
        }
        return $roller;
    }

    function getKullaniciRolleri($kullanici_id){
        GLOBAL $db;
        $sorgu_dizgesi = "
            SELECT * FROM kullanici_rol
                INNER JOIN kullanici ON kullanici_id = kullanici.id
                INNER JOIN rol ON rol_id = rol.id
            WHERE kullanici_id = ?
        ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sorgu->execute([$kullanici_id]);
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        $roller = [];
        foreach($sonuc as $rol){
            array_push($roller, $rol['rol_adi']);
        }
        return $roller;
    }

    function RolTanimla($kullanici_id, $rol_id){
        global $db;
        $sorgu_dizgesi = "
            INSERT INTO kullanici_rol
                (kullanici_id, rol_id)
            VALUES
                (?, ?);
        ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sonuc = $sorgu->execute([$kullanici_id,$rol_id]);
        return $sonuc;
    }

    function KullaniciEkle($yeni_kullanici){
        global $db;
        $yeni_kullanici['telefon'] = telefon_duzelt($yeni_kullanici['telefon']);
        $sorgu_dizgesi = "
            INSERT INTO kullanici
                (isim, soyisim, email, telefon, parola, kayit_tarihi, dogum_tarihi, adres_id)
            VALUES
                (?, ?, ?, ?, ?, CURRENT_TIMESTAMP, ?, ?);
        ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sonuc = $sorgu->execute(
            array(
                $yeni_kullanici['isim'],
                $yeni_kullanici['soyisim'],
                $yeni_kullanici['email'],
                $yeni_kullanici['telefon'],
                md5($yeni_kullanici['parola']),
                $yeni_kullanici['dogum_tarihi'],
                $yeni_kullanici['adres_id'],
            )
        );
        $kullanici_id = $db->lastInsertId();

        global $varsayilan_kullanici_rol_id;
        if(isset($varsayilan_kullanici_rol_id)){ // Eğer varsayilan_kullanici_rol_id tanımlı ise kayıt olan her kullanıcı bu role kayıt olur.
            RolTanimla($kullanici_id, $varsayilan_kullanici_rol_id);
        }
        return $sonuc;
    }

    function EpostaOnay($kullanici){
        GLOBAL $db;
        $sorgu_dizgesi = "UPDATE kullanici SET email_onay = 1 WHERE id = ? ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sonuc = $sorgu->execute([$kullanici['id']]);
        return $sonuc; // bool
    }

    function sha256($action, $string)
    {
        $output = false;
    
        $encrypt_method = 'AES-256-CBC';                // Default
        $secret_key = 'Some#Random_Key!';               // Change the key!
        $secret_iv = '!IV@_$2';  // Change the init vector!
    
        // hash
        $key = hash('sha256', $secret_key);
    
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
    
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
    
        return $output;
    }

    function DoğrulamaKoduOlustur($length) {
        $karakterler = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $kod = '';
      
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($karakterler) - 1);
            $kod .= $karakterler[$index];
        }
      
        return $kod;
    }


   function mail_gonder($email_adres, $content){
        try {
            $mail = new PHPMailer(true);
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail.kolekty.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->SMTPSecure = false;
            $mail->SMTPAutoTLS = false;
            $mail->Port     = 587; //Natro SMPT Mail Portu
            $mail->CharSet = 'UTF-8'; //Türkçe yazı karakterleri için CharSet  ayarını bu şekilde yapıyoruz.
            $mail->Username   = 'info@kolekty.com';                     //SMTP username
            $mail->Password   = '=q8XK3e2uB6_kZ@@';                               //SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            // $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('info@kolekty.com', 'Kolekty');
            $mail->addAddress($email_adres);
            $mail->addReplyTo('info@kolekty.com', 'Kolekty İletişim');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            // //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $content['subject'] . ' | Kolekty';
            $mail->Body    = $content['body'];
            $mail->AltBody = $content['alt_body'];
        
            $mail->send();
            return 1;
        } catch (Exception $e) {
            echo $e;
            return 0; // echo "Mail gönderilemedi. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    function doğrulama_kodu_gonder($email_adres, $doğrulamaKodu){
        try {
            $mail = new PHPMailer(true);
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail.kolekty.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->SMTPSecure = false;
            $mail->SMTPAutoTLS = false;
            $mail->Port     = 587; //Natro SMPT Mail Portu
            $mail->CharSet = 'UTF-8'; //Türkçe yazı karakterleri için CharSet  ayarını bu şekilde yapıyoruz.
            $mail->Username   = 'info@kolekty.com';                     //SMTP username
            $mail->Password   = '=q8XK3e2uB6_kZ@@';                               //SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            // $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('info@kolekty.com', 'Kolekty');
            $mail->addAddress($email_adres);
            $mail->addReplyTo('info@kolekty.com', 'Kolekty İletişim');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            // //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Mail Adresinizi Doğrulayın | Kolekty';
            $mail->Body    = 'Doğrulama Kodunuz: <b>' . $doğrulamaKodu . '</b>';
            $mail->AltBody = 'Doğrulama Kodunuz: ' . $doğrulamaKodu;
        
            $mail->send();
            return 1;
        } catch (Exception $e) {
            echo $e;
            return 0; // echo "Mail gönderilemedi. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    function parola_yenileme_baglantisi_gonder($email_adres, $kod){
        try {
            $mail = new PHPMailer(true);
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'mail.kolekty.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->SMTPSecure = false;
            $mail->SMTPAutoTLS = false;
            $mail->Port     = 587; //Natro SMPT Mail Portu
            $mail->CharSet = 'UTF-8'; //Türkçe yazı karakterleri için CharSet  ayarını bu şekilde yapıyoruz.
            $mail->Username   = 'info@kolekty.com';                     //SMTP username
            $mail->Password   = '=q8XK3e2uB6_kZ@@';                               //SMTP password
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            // $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('info@kolekty.com', 'Kolekty');
            $mail->addAddress($email_adres);
            $mail->addReplyTo('info@kolekty.com', 'Kolekty İletişim');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            // //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Parola Yenileme Bağlantınız | Kolekty';
            $mail->Body    = 'Parola Yenileme Bağlantınız : <a href="https://'.$_SERVER['SERVER_NAME'].'/ParolaYenile/' . $kod . '">https://'.$_SERVER['SERVER_NAME'].'/ParolaYenile/' . $kod . '</a>';
            $mail->AltBody = 'Parola Yenileme Bağlantınız: https://'.$_SERVER['SERVER_NAME'].'/ParolaYenile/' . $kod;
        
            $mail->send();
            return 1;
        } catch (Exception $e) {
            echo $e;
            return 0; // echo "Mail gönderilemedi. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    function getKullanicilar(){
        GLOBAL $db;
        $sorgu_dizgesi = "
            SELECT * FROM kullanici
        ";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $sorgu->execute();
        $sonuc = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        return $sonuc;
    }

    function update_kullanici($kullanici){
        GLOBAL $db;
        $sorgu_dizgesi = "UPDATE kullanici SET ";
        $kolonlar = array_keys($kullanici);
        foreach($kolonlar as $kolon){
            if($kolon != 'id'){
                $sorgu_dizgesi .= array_reverse($kolonlar)[0] == $kolon ? $kolon . " = ? ": $kolon . " = ? , ";
            }
        }
        $sorgu_dizgesi .= " WHERE id = ?";
        $sorgu = $db->prepare($sorgu_dizgesi);
        $degerler = array();
        foreach(array_values($kullanici) as $deger){
            if($deger != $kullanici['id']){
                array_push($degerler, $deger);
            }
        }
        array_push($degerler, $kullanici['id']);
        $sonuc = $sorgu->execute($degerler);
        return $sonuc;
    }
?>