function CreateUser()
{
	$("#dlg-create").dialog("open").dialog("center").dialog("setTitle", "Create User");
	$("#frm-create").form("clear");
}

function RemoveUser()
{
	var delete_function = BASE_URL + "/c_users/RemoveUser.html";
	var row = $("#dg").datagrid("getSelected");
	if (row)
	{
		$.messager.confirm("Confirm", "Are you sure you want to delete selected user?", function(r) {
			if (r)
			{
				$.post(delete_function, {id_user:row.id_user}, function(result) {
					if (result.success)
					{
						$("#dg").datagrid("reload");
						if ($("#dg").datagrid("getData").total - 1 == 0) $(location).attr("href", BASE_URL);
					} 
					else 
					{
						$.messager.show({
							title: "Error",
							msg: result.errorMsg
						});
					}
				}, "json");
			}
		});
	}
}

function SaveNewUser()
{
	var save_function = BASE_URL + "c_users/SaveNewUser.html"; 
	$("#frm-create").form("submit", {
		url: save_function,
		onSubmit: function(){
			return $(this).form("validate");
		},
		success: function(result){			
			var result = eval('('+result+')');
			if (result.errorMsg)
			{
				$.messager.show({
					title: "Error",
					msg: result.errorMsg
				});
			} 
			else 
			{
				$("#dlg-create").dialog("close"); 
				if ($("#dg").length) $("#dg").datagrid("reload");
				else $(location).attr("href", BASE_URL);
			}
		}
	});
}

function AddAddressField()
{
	if (COUNTER_ADDRESS > 3)
	{
		$.messager.alert({
			title: "Max Address",
			msg: "Maximum address : 3",
			icon: "warning"
		});
		
		return;
	}
	
	var new_div_addr = $(document.createElement("div")).attr("id", "div-addr" + COUNTER_ADDRESS);
	new_div_addr.after().html('<input id="address' + COUNTER_ADDRESS + '" name="address[]" />').trigger("create");
	new_div_addr.appendTo("#div-addr-grp");
	$("#address" + COUNTER_ADDRESS).addClass("easyui-textbox");
	$("#address" + COUNTER_ADDRESS).attr("data-options", "required:true");
	
	$("#address" + COUNTER_ADDRESS).textbox({});
	
	$("#div-addr-grp").trigger('refresh');
		  
	COUNTER_ADDRESS++;
}

function RemoveAddressField()
{
	if (COUNTER_ADDRESS == 2)
	{
		$.messager.alert({
			title: "Min Address",
			msg: "Min address : 1",
			icon: "warning"
		});
		
		return;
	}
        
	COUNTER_ADDRESS--;
			
    $("#div-addr" + COUNTER_ADDRESS).remove();		
}

$("#btn_add_addr").click(function() {
	AddAddressField();
});

$("#btn_rem_addr").click(function() {
	RemoveAddressField();
});

function DoSearch(reset)
{
	if (reset)
	{		
		$("#search").textbox("setText", "");
	}

	$("#dg").datagrid("load", {  
		search: $("#search").textbox("getText")             
	}); 

	$("#search").focus();
}