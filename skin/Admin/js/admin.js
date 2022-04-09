admin = {

	url : null,
	type : 'POST',
	data : {},
	dataType : 'json',
	form : null,

	setUrl : function (url) 
	{
		this.url = url;
		return this;
	},

	getUrl : function () 
	{
		return this.url;
	},

	setType : function (type) 
	{
		this.type = type;
		return this;
	},

	getType : function () 
	{
		return this.type;
	},

	setData : function (data) 
	{
		this.data = data;
		return this;
	},

	getData : function () 
	{
		return this.data;
	},

	setDataType : function (dataType) 
	{
		this.dataType = dataType;
		return this;
	},

	getDataType : function () 
	{
		return this.dataType;
		
	},

	setForm : function (form) 
	{
		this.form = form;
		this.prepareFormParams();
		return this;
	},

	getForm : function () 
	{
		return this.form;
	},

	load : function () 
	{
		$.ajax({
			type : this.getType(),
			url : this.getUrl(),
			data : this.getData(),
			success : function(data){
				$("#indexContent").html(data.content);
				$("#indexMessage").html(data.message);
			},
			dataType : this.getDataType()
		});
	},

	prepareFormParams : function()
	{
		this.setUrl(this.getForm().attr('action'));
		this.setType(this.getForm().attr('method'));
		this.setData(this.getForm().serializeArray());
		return this;
	}
};