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
                "ids"=>["b3cb8d0434286208f8f187f0e75f63b5"],
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

            var_dump($details);

            // $details=\OpswatPHP\Device::delete(['device_id'=>'b3cb8d0434286208f8f187f0e75f63b5','opt'=>1]);
           
            //var_dump($details);
          
            $details=\OpswatPHP\Device::action([
                "types" => "unexempt",
                "ids" => ["b3cb8d0434286208f8f187f0e75f63b5"]
            ]);

            var_dump($details);
            

            $details=\OpswatPHP\Device::info([
                "ids" => ["b3cb8d0434286208f8f187f0e75f63b5"],
                "opt"=> 0,
                "select"=> [
                    "categories"=> []
                ]
            ]);

            var_dump($details);

            $details=\OpswatPHP\Device::policy_check(["opt" => 0,
                       "MAC_list"=> [ 
                          "78:4f:43:7f:f5:fa"
                       ]]);
             
             var_dump($details);

            $details=\OpswatPHP\Device::stats(["event"=>"not_seen","period"=>"month","in"=>1]);

            var_dump($details);

            $details=\OpswatPHP\Device::all([
                        "limit"=> 20,
                        "page"=> 1
                    ]);

            var_dump($details);
            
            $details=\OpswatPHP\Device::remediation(['device_id'=>'b3cb8d0434286208f8f187f0e75f63b5','opt'=>1]);
            var_dump($details);

            $details=\OpswatPHP\Device::get_reports([
                    'type'=>'os_patch_summary'
            ]);
            var_dump($details);

            $details=\OpswatPHP\Device::get_threats(['id'=>'b3cb8d0434286208f8f187f0e75f63b5']);

            var_dump($details);
            $details=\OpswatPHP\Device::status_changed([
                "age"=>86400,
                "page"=> 1,
                "limit"=> 20,
                "verbose"=>1
            ]);
            
            var_dump($details);
    

            $details=\OpswatPHP\Group::all([
                        "limit"=>10,
                        "page"=> 1,
                        "sort"=> [
                            "order"=>"desc",
                            "field"=> "group_name"
                        ],
                        //"search"=> "antivirus"
                    ]);

            var_dump($details);


            $details=\OpswatPHP\Activity::all([
                        "action"=> [
                            "allowed"
                          ],
                          "page"=> 1,
                          "limit"=> 20,
                          
                    ]);

            var_dump($details);
    
            $details=\OpswatPHP\Log::all([
                    "filter"=> ["added", "deleted", "deleted_user", "unseen", "compliant", "noncompliant" ],
                    "page"=> 1,
                    "limit" => 20
                    ]);

            var_dump($details);


            $details=\OpswatPHP\App::all([
                    "page"=> 1,
                    "limit" => 20
                    ]);

            var_dump($details);

            $details=\OpswatPHP\App::details([
                       "product_id"=>5,
                       "version"=>"3.4.8.42449",
                       "verbose"=> [
                            "cves"=> 1
                        ]
                    ]);

            var_dump($details);
            
            $details=\OpswatPHP\Vulnerabilities::all([
                       "page"=>1,
                       "limit"=>20
                    ]);

            var_dump($details);
           

            $details=\OpswatPHP\Account::configuration([
                      "sections"=> ["cross-domain-api","regcode"]
                    ]);

            var_dump($details);

             

            $details=\OpswatPHP\Account::all();

            var_dump($details);

            $details=\OpswatPHP\Account::policy();

            var_dump($details);
