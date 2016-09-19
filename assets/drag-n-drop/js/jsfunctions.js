// JavaScript Document

//------------------------------ MAKE LIST FOR MYSQL (1)
$(function() {
	$( "#sortlist" ).sortable({
		update: function(){
			$('#message').html('<div class="alert alert-danger">Item have been moved but not saved</div>');
		}
	});
});

// //--------- SAVE THE ORDER
// $('#button').click(function(event){
// 	alert('me');
//        var order = $("#sortlist").sortable("serialize");
//        $('#message').html('Saving changes..');
//        $.post("<?php echo base_url();?>/course/save_order",order,function(theResponse){
//                      $('#message').html(theResponse);
//                      });
//        event.preventDefault();
// });

// //------------------------------ COOKIE SESSION SAVES


// set the list selector
var setSelector = "#sortlistTwo";
// set the cookie name
var setCookieName = "listOrder";
// set the cookie expiry time (days):
var setCookieExpiry = 7;
 

function getOrder() {
	$.cookie(setCookieName, $(setSelector).sortable("toArray"), { expires: setCookieExpiry, path: "/" });
}
 

function restoreOrder() {
	var list = $(setSelector);
	if (list == null) return
 
	var cookie = $.cookie(setCookieName);
	if (!cookie) return;

	var IDs = cookie.split(",");

	var items = list.sortable("toArray");
 
	var rebuild = new Array();
	for ( var v=0, len=items.length; v<len; v++){
		rebuild[items[v]] = items[v];
	}
 
	for (var i = 0, n = IDs.length; i < n; i++) {
 
		var itemID = IDs[i];
 
		if (itemID in rebuild) {
 
			// select item id from current order
			var item = rebuild[itemID];
 
			// select the item according to current order
			var child = $("ul" + setSelector + ".ui-sortable").children("#" + item);
 
			// select the item according to the saved order
			var savedOrd = $("ul" + setSelector + ".ui-sortable").children("#" + itemID);
 
			// remove all the items
			child.remove();
 
			// add the items in turn according to saved order
			// we need to filter here since the "ui-sortable"
			// class is applied to all ul elements and we
			// only want the very first!  You can modify this
			// to support multiple lists - not tested!
			$("ul" + setSelector + ".ui-sortable").filter(":first").append(savedOrd);
		}
	}
}
 
// code executed when the document loads
$(function() {
	// here, we allow the user to sort the items
	$(setSelector).sortable({
		axis: "y",
		cursor: "move",
		update: function() { getOrder(); }
	});
 
	// here, we reload the saved order
	restoreOrder();
});