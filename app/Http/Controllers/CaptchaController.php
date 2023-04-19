<?php
//http://127.0.0.1:8000/captcha_solver
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DOMDocument;
use Illuminate\Support\Facades\Http;
use  Illuminate\Http\UploadedFile;
use App\Http\Controllers\COOKIE; 
use App\Http\Controllers\Exception;


use HeadlessChromium\BrowserFactory;
use HeadlessChromium\Page;
use HeadlessChromium\Clip;
use HeadlessChromium\PageUtils\Navigation;
class CaptchaController extends Controller
{
    function index(){
       
        echo "Applications";
       // require '/Applications/XAMPP/htdocs/laravel-crud/vendor/autoload.php';
        require '/Applications/XAMPP/xamppfiles/htdocs/laravel-crud/vendor/autoload.php';
        
       /* define('COOKIE', '');

        function getUrl($url, $method='', $vars='', $open=false) {
            $agents = 'Mozilla/5.0 (X11; U; Linux i686; en-US) AppleWebKit/534.16 (KHTML, like Gecko) Chrome/10.0.648.204 Safari/534.16';
            $header_array = array(
                "Via: 1.1 register.pandi.or.id",
                "Keep-Alive: timeout=15,max=100",
            );
            
            $cookie = session_name() . '=' . time();
            $referer = 'https://www.dgca.gov.in/digigov-portal/web?requestType=ApplicationRH&actionVal=checkLogin';
            $ch = curl_init();
            if ($method == 'post') {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "$vars");
            }
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header_array);
            curl_setopt($ch, CURLOPT_USERAGENT, $agents);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 5);
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_REFERER, $referer);
            curl_setopt($ch, CURLOPT_COOKIE, $cookie);
            curl_setopt($ch, CURLOPT_COOKIEJAR, COOKIE);
            curl_setopt($ch, CURLOPT_COOKIEFILE, COOKIE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

            $buffer = curl_exec($ch);
            if (curl_errno($ch)) {
                echo "error " . curl_error($ch);
                die;
            }
            curl_close($ch);
            return $buffer;
        }


        $url = 'https://www.dgca.gov.in/digigov-portal/jsp/dgca/common/login.jsp';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($ch);
        curl_close($ch);

       // get image from site 
        $dom = new \DOMDocument();
        @$dom->loadHTML($html);
        $img = $dom->getElementsByTagName('img')[4]->getAttribute('src');

       $csrf = $dom->getElementsByTagName('meta')[0]->getAttribute('content');
       echo $url = 'https://www.dgca.gov.in/digigov-portal/'.$img;
       echo "<br>";
       echo '$csrf'.$csrf."<br>";


      // upload image on our server 
        $img = '/Applications/MAMP/htdocs/laravel-crud/captcha.jpg';
        file_put_contents($img, file_get_contents($url));

        // read image 
        $solver = new \TwoCaptcha\TwoCaptcha('827da00473c0c3c92b14bb7c3df1d07a');
        $result = $solver->normal('/Applications/MAMP/htdocs/laravel-crud/captcha.jpg');
        // print_r($result);
      echo $captcha = strtoupper($result->code);
      echo "<br>";
        echo $result->code . "<br>";  

        // --- send post request to login the site ---- 
     
        //   -- captcha request  --  
        //  $ch = curl_init();
        //  curl_setopt($ch, CURLOPT_URL, 'https://www.dgca.gov.in/digigov-portal/web');
        //  curl_setopt($ch, CURLOPT_POST, 1);
        //  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        //  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
        //      'requestType' => 'ApplicationRH',
        //      'actionVal' => 'menuList',
        //      'screenId' => '114',
        //      'PRNT_MENU_ID' => '200939',
        //      '_csrf' => $csrf,

             
        //  )));
        //  curl_setopt($ch, CURLOPT_HEADER, true);
        //  $response = curl_exec($ch);
   
        //  // Close the cURL session
        //  curl_close($ch);
        //  echo "csrf----------";
        //  echo "<pre>";
        //  print_r($response);
   


     //  -- login request  --  
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://www.dgca.gov.in/digigov-portal/j_spring_security_check');
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
          'captcha_val' => $captcha,
          'username' => 'IPLTM2020023010',
          'password' => 'DU/mqejsr9DcpS47moC3/w==',
          'txt_Captcha' => $captcha,
          'cmb_UserType' => '65000060115',
          
      )));
      curl_setopt($ch, CURLOPT_HEADER, true);
      $response = curl_exec($ch);

      // Close the cURL session
      curl_close($ch);
      echo "response----------";
      echo "<pre>";
      print_r($response);

      
       

       //   if(!empty($response)){

          
        
        //  $curl = curl_init();

        //   curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'https://www.dgca.gov.in/digigov-portal/web?requestType=ApplicationRH&actionVal=checkLogin',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => false,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'GET',
        //     CURLOPT_HTTPHEADER => array(
        //       'Cookie: JSESSIONID=0F2C30578706E1623F2EDFD2A59B8547; TS01d1748c=0173e2c6d34e3e112fc7d3deaa70b8498f06fcfdb01828764061d51c4a4be91e5be39f11f701501a7cadeda13d8fb3638932d5c9e4de2c3393c7a5a62cff34dfb168ad3261; AWSALB=i2+MCSjY5zRvLIBFRnGR9B9/eTzumDCpbxz+6dYyO63KHbekXJp8sg80ShjPV5hXELnrj+UbPP+vkMuJOa1uUEMiBWvKayZ3nMmmp1vAmLzH6LAChlqHsxbPcf2U; AWSALBCORS=i2+MCSjY5zRvLIBFRnGR9B9/eTzumDCpbxz+6dYyO63KHbekXJp8sg80ShjPV5hXELnrj+UbPP+vkMuJOa1uUEMiBWvKayZ3nMmmp1vAmLzH6LAChlqHsxbPcf2U; TS01db54b7=0173e2c6d3dca8279030d217af7063276eea76e9a721384e6f9b4244cd6073dbabc7a8d8250d0b9b1ceb9648dd95d195812db7061a172b2e0b7da3f01e8434a181a0b4b0d82ee212a5d146065d9c19de68a802c19f'
        //     ),
        //   ));
          
        //   $response = curl_exec($curl);
          
        //   curl_close($curl);
        //   echo "GETresponse----------";
        //   echo "<pre>";
        //   print_r($response);
          
       // }*/
 
        try {

            require '/Applications/XAMPP/htdocs/laravel-crud/vendor/autoload.php';
            // create browser instance
           /* $browserFactory = new BrowserFactory();
            $browser = $browserFactory->createBrowser();*/

            $options = [
                'headless' => false,
                'noSandbox' => true,
                'keepAlive' => true,
                'disable-gpu' => true,// add this flag to show the browser window
                'closeOnExit' => false, // set this option to false to keep the browser open

            ];
            
            // create browser
            $browserFactory = new BrowserFactory();
            //$browser = $browserFactory->createBrowser($options);
            $browser = $browserFactory->createBrowser();
        
            // create a new page
            $page = $browser->createPage();
        
            // set viewport size to desktop resolution
            // set viewport size to desktop resolution
            $viewportWidth = 1920;
            $viewportHeight = 1080;
            $page->setViewport($viewportWidth, $viewportHeight);
        
            // navigate to URL
            $page->navigate('https://www.dgca.gov.in/digigov-portal/jsp/dgca/common/login.jsp')->waitForNavigation();
        
             // specify the area to capture
            $x = 956;
            $y = 330;
            $width = 110;
            $height = 50;
            $clip = new Clip($x, $y, $width, $height);
            // take screenshot of the specified area
            $screenshot = $page->screenshot([
                'clip' => $clip,
                'format' => 'jpeg',
            ]);
            // generate image
            $screenshot->saveToFile('/Applications/XAMPP/htdocs/laravel-crud/captcha.jpg');
        
            // generate PDF of entire page
            $page->pdf(['printBackground' => true])->saveToFile('/Applications/XAMPP/htdocs/laravel-crud/captcha.pdf');
            

             // read image 
            $solver = new \TwoCaptcha\TwoCaptcha('827da00473c0c3c92b14bb7c3df1d07a');
            $result = $solver->normal('/Applications/XAMPP/htdocs/laravel-crud/captcha.jpg');
            // print_r($result);
            echo $captcha = strtoupper($result->code);
            
            echo "<br>";

              // execute JavaScript code to set attribute value
            $elementSelector = 'input[name="txt_Captcha"]';
            $attributeName = 'value';
            $attributeValue = $captcha;
            $page->evaluate("
                var element = document.querySelector('$elementSelector');
                element.setAttribute('$attributeName', '$attributeValue');
            ");
              // execute JavaScript code to set attribute value
            $elementSelector = 'input[name="username"]';
            $attributeName = 'value';
            $attributeValue = 'IPLTM2020023010';
            $page->evaluate("
                var element = document.querySelector('$elementSelector');
                element.setAttribute('$attributeName', '$attributeValue');
            ");
              // execute JavaScript code to set attribute value
            $elementSelector = 'input[name="password"]';
            $attributeName = 'value';
            $attributeValue = 'Fighters12!';
            $page->evaluate("
                var element = document.querySelector('$elementSelector');
                element.setAttribute('$attributeName', '$attributeValue');
            ");
            

            // check captcha value
            $elem = $page->dom()->search('//input[@id="txt_Captcha"]')[0];
            $attr = $elem->getAttribute('value');
            echo "txt_Captcha: ".$attr;
            echo "<br>";

            // check username value
            $elem = $page->dom()->search('//input[@id="username"]')[0];
            $attr = $elem->getAttribute('value');
            echo "username: ".$attr;
            echo "<br>";


            // check password value
            $elem = $page->dom()->search('//input[@id="password"]')[0];
            $attr = $elem->getAttribute('value');
            echo "password: ".$attr;
            echo "<br>";

            
            // find the button element
            $page->evaluate("
                    var btn = document.querySelector('div.tab-pane.fade.show.active button');
                    if (btn) {
                        btn.click();
                    }
                ");
            
            $page->waitForReload();
           // $login_btn = $page->dom()->search('//div[@class="tab-pane fade show active"]//button[@type="button"]')[0];
           // $btn_attr = $login_btn->getAttribute('class');

            //click on login btn
            sleep(5);
         

            // get the logout button element and retrieve its class attribute
            $logout_elem = $page->dom()->search('//a[@id="Logout_btn"]')[0];
            $logout_attr = $logout_elem->getAttribute('class');
            echo "logout_elem: ".$logout_attr;
            echo "<br>";
            

           
            $login_elem = $page->dom()->search('//div[@class="side-tabs"]//div[@class="collapse-tabs"]//a')[0];
            $login_attr = $login_elem->getAttribute('class');
            echo "logout_attr: ".$login_attr;
            echo "<br>"; 
            
            


            // // find the E-log book (sidebar)
            // $page->evaluate("
            //         var btn = document.querySelector('.side-tabs .collapse-tabs a');
            //         if (btn) {
            //             btn.click();
            //         }
            //     ");
            // sleep(2);
          

            // find the view E-log book  (sidebar)

            $page->evaluate("
                var btn = document.querySelector('#a90000603 ul:nth-child(4) li a');
                if (btn) {
                    btn.click();
                }
             ");
            
             sleep(5);
            
             
            // add value to "from date"(searchFromDate)
            $elementSelector = 'input[name="searchFromDate"]';
            $attributeName = 'value';
            $attributeValue = '01/04/2022';
            $page->evaluate("
                var element = document.querySelector('$elementSelector');
                element.setAttribute('$attributeName', '$attributeValue');
            ");

              // add value to "To date"(searchToDate)
              $elementSelector = 'input[name="searchToDate"]';
              $attributeName = 'value';
              $attributeValue = '05/04/2023';
              $page->evaluate("
                  var element = document.querySelector('$elementSelector');
                  element.setAttribute('$attributeName', '$attributeValue');
              ");



            // check searchFromDate value
            $elem = $page->dom()->search('//input[@id="searchFromDate"]')[0];
            $attr = $elem->getAttribute('value');
            echo "searchFromDate: ".$attr;
            echo "<br>";
             
            // submit the form(click on buttonSearch btn)
            $page->evaluate("
                var btn = document.querySelector('button#buttonSearch');
                if (btn) {
                    btn.click();
                }
            ");
   
            sleep(5);
            

            // download the pdf(click on pdf showDownload btn)
            $page->evaluate("
                var btn = document.querySelector('#showDownload a:nth-child(1)');
                if (btn) {
                    btn.click();
                }
            ");



            echo "logout_attr: ".$logout_attr;
            echo "<br>";
            echo "finish";
        } catch (\Exception $e) {

            echo 'error'.$e->getMessage();
         }
        //finally {
        //     // close browser
        //    // $browser->close();
        // }
      
         
     }
}
