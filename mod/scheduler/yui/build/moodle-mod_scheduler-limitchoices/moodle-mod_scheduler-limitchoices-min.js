YUI.add("moodle-mod_scheduler-limitchoices",function(e,t){M.mod_scheduler=M.mod_scheduler||{},MOD=M.mod_scheduler.limitchoices={},MOD.allSlotboxes=function(){return e.all("table#slotbookertable input.slotbox")},MOD.checkLimits=function(e){checkedcnt=0,this.allSlotboxes().each(function(e){e.get("checked")&&checkedcnt++}),disableunchecked=checkedcnt>=e,this.allSlotboxes().each(function(e){disablebox=!e.get("checked")&&disableunchecked,e.set("disabled",disablebox)})},MOD.init=function(e){this.checkLimits(e),this.allSlotboxes().on("change",function(){M.mod_scheduler.limitchoices.checkLimits(e)})}},"@VERSION@",{requires:["base","node","event"]});
