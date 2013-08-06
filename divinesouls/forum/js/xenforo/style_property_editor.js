/*
 * XenForo style_property_editor.min.js
 * Copyright 2010-2013 XenForo Ltd.
 * Released under the XenForo License Agreement: http://xenforo.com/license-agreement
 */
(function(c,f,e){XenForo.StylePropertyForm=function(b){b.bind("submit",function(){var a=c("#propertyTabs").data("XenForo.Tabs"),d=a.getCurrentTab(),a=a.api.getCurrentTab().closest("li.PropertyTab");b.find("input[name=tab_index]").val(d);b.find("input[name=tab_id]").val(a.attr("id"));d=b.serialize();b.find("input:not(input[type=hidden]), select, textarea").removeAttr("name");c('<input type="hidden" name="_xfStylePropertiesData" />').val(d).appendTo(b)});location.hash&&(location.hash.indexOf("#tab-")==
0?c("#propertyTabs").data("XenForo.Tabs").click(parseInt(location.hash.substr(5),10)):c("#propertyTabs").data("XenForo.Tabs").click(c("#propertyTabs > li").index(e.getElementById(location.hash.substr(1)))))};XenForo.StylePropertyEditor=function(b){b.find(".TextDecoration input:checkbox").click(function(a){a=c(a.target);console.log("Text-decoration checkbox - Value=%s, Checked=%s",a.attr("value"),a.is(":checked"));a.is(":checkbox")||a.attr("checked",!a.is(":checked"));a.is(":checked")&&(a.attr("value")==
"none"?c(this).not('[value="none"]').attr("checked",!1):c(this).filter('[value="none"]').attr("checked",!1))})};XenForo.StylePropertyTooltip=function(b){var a=b.find("div.DescriptionTip").addClass("xenTooltip propertyDescriptionTip").appendTo("body").append('<span class="arrow" />');a.length&&b.tooltip(XenForo.configureTooltipRtl({position:"bottom left",offset:[-24,-3],tip:a,delay:0}))};XenForo.register("#PropertyForm","XenForo.StylePropertyForm");XenForo.register(".StylePropertyEditor","XenForo.StylePropertyEditor");
XenForo.register("#propertyTabs > li","XenForo.StylePropertyTooltip")})(jQuery,this,document);