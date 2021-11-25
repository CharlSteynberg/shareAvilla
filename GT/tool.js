
extend(MAIN)({GT:
{
    appeal: function(act,qry)
    {
        return pledge(this,function(cbf)
        {
            purl({target:"/GT/"+act, convey:qry, silent:true}, cbf);
        });
    },


    select: function(qry)
    {
        if (isText(qry)){ qry = {fetch:qry} }
        return this.appeal("select",qry);
    },



    insert: function(qry)
    {
        return this.appeal("insert",qry);
    },
}});



server.listen("gtImport",function(data)
{
    if (data == INIT){ return }
    let busy = data.busy;
    let bufr = data.bufr;
    let temp = create("div");

    data = [];

    temp.innerHTML = bufr;  bufr="";
    temp.select(".related-ad-content").forEach((item)=>
    {
        let drow = {};

        drow.advertID = item.select(".watchListV2")[0].getAttribute("data-short-adid");
        drow.gtAdHref = item.select(".related-ad-title")[0].getAttribute("href");
        drow.modified = time(item.select(".creation-date")[0].select("span")[0].innerHTML);
        drow.category = proprCase(drow.gtAdHref.slice(3).split("/")[0]);
        drow.flagTags = "";
        drow.smallPic = "";
        drow.heroShot = "";
        drow.location = item.select(".location-date")[0].select("span")[0].innerHTML.trim();
        drow.thePrice = (item.select(".ad-price")[0].innerHTML.trim().slice(2).split(",").join("") * 1);
        drow.theTitle = item.select(".related-ad-title")[0].select("span")[0].innerHTML.trim();
        drow.theWords = "";

        data.radd(drow);
    });

    GT.insert({write:data}).then(function(rsl)
    {
        dump("insert progress: "+this.busy);
    }.bind({busy:busy}));
});
