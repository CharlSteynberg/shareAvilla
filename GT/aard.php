<?
namespace Anon;



# tool :: GT : stem handler
# ---------------------------------------------------------------------------------------------------------------------------------------------
    class GT
    {
        static $meta;
        static $data;

        
        
        static function __init()
        {
            permit::fubu(); // security!!
            self::$data = "sqlite::/GT/data/base.sdb/adverts";
        }

        
        
        static function _select($qry)
        {
            $fet = $qry->fetch;
            $rsl = plug(self::$data)->select($qry);

            if (($fet === "*") && (span($rsl) < 1))
            {
                self::_import(); wait(250);
                $rsl = plug(self::$data)->select($qry);
            };

            return $rsl;
        }

        
        
        static function _insert($qry)
        {
            $rsl = plug(self::$data)->insert($qry);
            // $rws = ((isKnob($qry) && isNuma($qry->write)) ? $qry->write : (isNuma($qry)?$qry:[])); 

            // foreach($rws as $row)
            // {
            //     if (isAssa($row)){ $row=knob($row); };  if (!isKnob($row)){ continue; };
            //     ekko($row->gtAdHref);
            // };

            return $rsl;
        }

        
        
        static function _import($done=0,$todo=null)
        {
            if (!isInum($done)||!isInum($todo))
            {
                $done = 0;
                $todo = null;
                signal::gtImport(INIT); wait(60);
            };


            if (!$todo)
            { signal::busy(['with'=>"/GT/import","done"=>11]); wait(60); };

            $conf = conf("GT/autoConf");
            $user = ($conf->dataPath."/".$conf->userName);
            $purl = ($conf->dataHost."/$user/".$conf->userHash);
            $done = ($done + 1);
            $path = "/GT/data/temp/p{$done}.html";
            $page = pget($path);
            $aged = aged($path);
            $time = time();

            if (!is_int($aged) || ($aged > $conf->waitTime))
            { $page = spuf($purl."p".$done);  pset($path,$page); };

            if (!$todo)
            {
                $todo = stub($page,('<a class="last" href="/'.$user.'/page-'))[2];
                $todo = (stub($todo,'/')[0] * 1);
            };

            $bufr = stub($page,'<div class="related-items"><div class="related-content" onclick="void(0)">')[2];
            $bufr = stub($bufr,'</div></div></div>')[2];
            $bufr = stub($bufr,'<div class="reply-form-v1-container"></div></div></div></div>')[0];
            $busy = floor(($done/$todo)*100);

            wait(rand(300,800));
            signal::gtImport(["buzy"=>$busy,"bufr"=>$bufr]); // client-side parsing
            wait(rand(800,2600));
            unset($page,$bufr); // clean up

            signal::busy(['with'=>"/GT/import","done"=>$busy]);
            wait(60);

            if ($done < $todo)
            { self::_import($done,$todo); };

            return OK;
        }


        
        
        static function __callStatic($act,$arg)
        {
            $act = "_$act";  if (!isset($arg[0])){ $arg[0]=$_POST; };  
            $qry = $arg[0];  // prep
            $opt = "fetch";
            $slf = "Anon\GT";

            if (!isin($act,["select"])){ permit::fubu("clan:work");  $opt="write"; };
            if (!isin($slf,$act)){ fail(501); return; };
            if (isText($qry)){ $qry = [$opt=>$qry]; };
            if (isAsso($qry)){ $qry = knob($qry); };  
            
            expect::knob($qry);
            return self::$act($qry);
        }
    }
# ---------------------------------------------------------------------------------------------------------------------------------------------
