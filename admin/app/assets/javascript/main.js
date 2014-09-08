function CardType(name, value) {
	var self = this;
	self.name = ko.observable(name);
	self.value = ko.observable(value);
}

function CardViewModel(cardTypes, cardData) {
	var self = this;

  var cardTypesArray = [];

  if (typeof cardTypes != 'undefined') {
    for (var i = 0; i < cardTypes.length; i++) {
      cardTypesArray.push(new CardType(cardTypes[i], cardTypes[i]));
    }
  }

  self.id = ko.observable(cardData.id);
	self.cardTypes = ko.observableArray(cardTypesArray);
	self.cardType = ko.observable(cardData.card_type);
	self.instantaneousName = ko.observable(cardData.name);
	self.name = ko.computed(this.instantaneousName)
        .extend({ rateLimit: { method: "notifyWhenChangesStop", timeout: 400 } });

	self.instantaneousEffect = ko.observable(cardData.effect);
	self.effect = ko.computed(this.instantaneousEffect)
        .extend({ rateLimit: { method: "notifyWhenChangesStop", timeout: 400 } });

	self.strength = ko.observable(cardData.strength);
	self.fileHash = ko.observable(cardData.image_path);

	// TODO Handle page breaks
	self.imageUrl = ko.computed(function () {
		return './card-maker/cards/preview?name=' + self.name() +
		'&effect=' + self.effect() + '&strength=' + self.strength() +
		'&type=' + self.cardType() + '&fileId=' + self.fileHash();
	});
}



$(function() {
  if (typeof window.card != 'undefined') {
    $.get('./card-maker/cards/card_types', function (data) {
      var json = JSON.parse(data);

      window.bindings = new CardViewModel(json.card_types, window.card);
      ko.applyBindings(window.bindings);
    });
  }


  $("#image").change(function (){
    var $self = $(this);
    var formData = new FormData($self.closest('form')[0]);
    $.ajax({
        url: $self.attr('data-action'),  //Server script to process data
        type: 'POST',
        xhr: function() {  // Custom XMLHttpRequest
            var myXhr = $.ajaxSettings.xhr();
            if(myXhr.upload){ // Check if upload property exists
                //myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // For handling the progress of the upload
            }
            return myXhr;
        },
        //Ajax events
        //beforeSend: beforeSendHandler,
        success: function (data) {
          var json = JSON.parse(data);
          window.bindings.fileHash(json.hash);
        },
      error: function (data) {console.log(data)},
        // Form data
        data: formData,
        //Options to tell jQuery not to process data or worry about content-type.
        cache: false,
        contentType: false,
        processData: false
    });
  });
});
