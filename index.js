GT.select("*").then((rsp)=>
{
    rsp = decode.jso(rsp.body);
    dump(rsp);
});
