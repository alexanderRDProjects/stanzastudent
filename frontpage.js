class HashResolver
{
	constructor()
	{
		this.hashMap = {};

		var hashResolver = this;

		$(document).ready(function()
		{
			hashResolver.resolve();

			window.onhashchange = function()
			{
				hashResolver.resolve();
			};
		})
	}

	register(addr, callback)
	{
		this.hashMap[addr] = callback;
	}

	getHash()
	{
		var hash = window.location.hash;

		return hash.substring(1, hash.length);
	}

	resolve()
	{
		var hash = this.getHash();
		
		if(hash in this.hashMap)
		{
			var resolveFn = this.hashMap[hash];

			resolveFn(hash);
		}
	}
}

class StepManager
{
	constructor(hashResolver, steps)
	{
		this.steps = steps;
		this.curStep = 0;

		for(var s in this.steps)
		{
			var step = this.steps[s]

			hashResolver.register(step.hash, step.callback);
		}
	}

	goToStep(step)
	{
		if(step === undefined)
			step = 0;

		this.curStep = step;

		window.location.hash = this.steps[this.curStep].hash;
	}
}

class ClientStepManager extends StepManager
{
	constructor(hashResolver)
	{
		var steps = 
		[
			{
				'hash':"client_has_group",
				'callback':doClientHasGroup,
			},
			{
				'hash':"client_group_size",
				'callback':doClientGroupSize
			},
			{
				'hash':"client_age",
				'callback':doClientAge
			},
			{
				'hash':"client_gender_prefs",
				'callback':doClientGenderPrefs
			}
		]

		super(hashResolver, steps);
	}
}

var curCard = $("#card0");
curCard.css("left", "calc(50% - 300px)");
var nxtCard = null;

function transitionCardOut()
{
	curCard.css("left", "-620px");
}

function transitionCardIn()
{
	// Add class

	nxtCard.addClass("card_current");
	nxtCard.removeClass("card_hidden");

	// Move card to the far right

	var width = $(document).width();
	
	nxtCard.css("transition", "none");
	nxtCard.css("left", "100%");

	// Do transition

	setTimeout(function()
	{
		nxtCard.css("transition", "");
		nxtCard.css("left", "calc(50% - 300px)");

		curCard = nxtCard;
		nxtCard = null;
	}, 50);
}



function swapCard(withCard)
{
	nxtCard = withCard;

	transitionCardOut();
	transitionCardIn();
}

var resolver = new HashResolver();
resolver.register("", doHome)
var clientStepManager = new ClientStepManager(resolver);

function doHome()
{
	swapCard($("#card0"));
}

function doClient()
{
	// STEP 0

	clientStepManager.goToStep(0);
}

function doClientHasGroup()
{
	// Show card

	swapCard($("#cl_has_group"))

	// Set listeners

	$("#btn_cl_no_group").click(function()
	{
		var hiddenForm_groupSize = $("#form_client_group_size");

		hiddenForm_groupSize.val(0);

		window.location.hash = "client_age";
	})

	$("#btn_cl_group").click(function()
	{
		window.location.hash = "client_group_size";
	})
}

function doClientGroupSize()
{
	// Show card

	swapCard($("#cl_group_size"));

	// Set listeners

	$("#btn_cl_group_size").click(function()
	{
		var hiddenForm_groupSize = $("#form_client_group_size");
		var input_groupSize = $("#in_cl_group_size").val()

		hiddenForm_groupSize.val(input_groupSize);

		window.location.hash = "client_age";
	});
}

function doClientAge()
{
	// Show card

	swapCard($("#cl_age"));

	// Set listeners

	$("#btn_cl_age").click(function()
	{
		var hiddenForm_age = $("#form_client_age");
		var input_age = $("#in_cl_age").val();

		hiddenForm_age.val(input_age);

		window.location.hash = "client_gender_prefs"
	});
}

function doClientGenderPrefs()
{
	swapCard($("#cl_gender_prefs"));

	$("#cl_gender_prefs button").css("width", "100px");

	$("#btn_cl_male").click(function()
	{
		var hiddenForm_genderPrefs = $("#form_client_gender_prefs");

		hiddenForm_genderPrefs.val(0);

		doClientSubmit();
	});

	$("#btn_cl_female").click(function()
	{
		var hiddenForm_genderPrefs = $("#form_client_gender_prefs");

		hiddenForm_genderPrefs.val(1);

		doClientSubmit();
	});

	$("#btn_cl_mixed").click(function()
	{
		var hiddenForm_genderPrefs = $("#form_client_gender_prefs");

		hiddenForm_genderPrefs.val(2)

		doClientSubmit();
	});
}

function doClientSubmit()
{
	$("#form_client").submit();
}

function t()
{
	return $("#form_client").serialize();
}