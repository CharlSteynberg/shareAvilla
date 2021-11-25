"use strict";


requires(["/GT/bits/aard.css"]);



select("#AnonAppsView").insert
([
   {panl:"#GTPanlSlab", contents:
   [
      {grid:".AnonPanlSlab", contents:
      [
         {row:
         [
            {col:".sideMenuView", contents:
            [
               {grid:
               [
                  {row:[{col:".slabMenuHead", contents:"GT"}]},
                  {row:[{col:".panlHorzLine", contents:[{hdiv:""}]}]},
                  {row:[{col:'.slabMenuBody', contents:[{grid:
                  [
                     {row:[{col:'#GTToolView', contents:[{panl:'#GTToolPanl .sideMenuToolPanl', contents:
                     [

                     ]}]}]},
                     {row:[{col:'.panlHorzLine', contents:[{hdiv:''}]}]},
                     {row:[{col:'#GTTreeView', contents:[{panl:'#GTTreePanl .sideMenuTreePanl', contents:
                     [
                        {treeview:'', source:'/User/treeMenu', uproot:true, listen:
                        {
                           'LeftClick':function(evnt)
                           {
                              let ctrl=evnt.ctrlKey; let shft=evnt.shiftKey;
                              if(ctrl||shft){evnt.stopImmediatePropagation(); evnt.preventDefault(); evnt.stopPropagation();};
                              Anon.GT.open(this.info.path,this.info.type,(ctrl?'ctrl':(shft?'shft':VOID)));
                           },
                        }}
                     ]}]}]},
                  ]}]}]},
               ]}
            ]},
            {col:".panlVertDlim", role:"gridFlex", axis:X, target:"<", contents:[{vdiv:""}]},
            {col:
            [
               {grid:
               [
                  {row:[{col:"#GTHeadView .slabViewHead", contents:[{tabber:"#GTTabber", theme:".dark", target:"#GTBodyPanl"}]}]},
                  {row:[{col:".panlHorzLine", contents:[{hdiv:""}]}]},
                  {row:[{col:".slabViewBody", contents:[{panl:"#GTBodyPanl"}]}]},
               ]}
            ]},
         ]}
      ]}
   ]}
]);




extend(Anon)
({
   GT:
   {
      anew:function(cbf)
      {
      },


      init:function()
      {
         Busy.edit("/GT/panl.js",100);
         signal("GTAppReady");
      },


      open:function(p)
      {
         dump("TODO :: GT.open "+p);
      },
   }
});