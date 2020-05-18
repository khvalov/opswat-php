# opswat-php
OPSWAT MetaAccess php client 
Not for production (yet)! 

All contributions are welcome!

Examples: 


            $deviceID='some-id';


            $url='https://gears.opswat.com/o/oauth/token?client_id={%CLIENT_ID%}&client_secret={%CLIENT_SECRET%}&grant_type=client_credentials';


            $_tmp=json_decode(file_get_contents($url));


            $key=$_tmp->access_token;

            \OpswatPHP\OpswatPHP::setApiKey($key);
            
            $details=\OpswatPHP\Device::details(
                [
                "opt"=> 1,
                "ids"=>[$deviceID],
                "verbose"=>[
                    "system_info"=> 1,
                    "categories"=>1,
                    "unclassified"=> 1,
                    "mobile_apps"=>1,
                    "detected_processes"=>1,
                    "detected_packages"=> 1,
                    "detected_patches"=>1
                ]
            ]
            );
            
            $details=\OpswatPHP\Device::delete(['device_id'=>$deviceID,'opt'=>1]);
           


            $details=\OpswatPHP\Device::action([
                "types" => "unexempt",
                "ids" => [$deviceID]
            ]);

            

            $details=\OpswatPHP\Device::info([
                "ids" => [$deviceID],
                "opt"=> 0,
                "select"=> [
                    "categories"=> []
                ]
            ]);


            $details=\OpswatPHP\Device::policy_check(["opt" => 0,
                       "MAC_list"=> [ 
                          "78:4f:43:7f:f5:fa"
                       ]]);
             

            $details=\OpswatPHP\Device::stats(["event"=>"not_seen","period"=>"month","in"=>1]);
            
            $details=\OpswatPHP\Device::all([
                        "limit"=> 20,
                        "page"=> 1
                    ]);
            

            $details=\OpswatPHP\Device::remediation(['device_id'=>$deviceID,'opt'=>1]);
            

            $details=\OpswatPHP\Device::get_reports([
                    'type'=>'os_patch_summary'
            ]);


            $details=\OpswatPHP\Device::get_threats(['id'=>$deviceID]);

            
            $details=\OpswatPHP\Device::status_changed([
                "age"=>86400,
                "page"=> 1,
                "limit"=> 20,
                "verbose"=>1
            ]);
            
            var_dump($details);
