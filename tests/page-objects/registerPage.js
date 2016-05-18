module.exports = function(browser) {

  this.submitForm = function() {
    browser
      .click("button[name=send_register]")
      .pause(500);

    return this;
  };

  this.closeAlertMessage = function() {
    browser
      .setAlertText(browser.Keys.ENTER)
      .pause(100);

    return this;
  };

  this.assertThatErrorMessageIs = function(message) {
    var assert = browser.assert;
    browser.getAlertText(function(info) {
      var errorMessage = info.value;
      assert.equal(errorMessage, message, "The error messages are equal.");
    });

    return this;
  };

  this.fillName = function(name) {
    browser
      .waitForElementPresent("input[name=name]", 1000)
      .setValue("input[name=name]", name)
      .pause(500);

    return this;
  };

  this.fillLastName = function(lastName) {
    browser
      .waitForElementPresent("input[name=lastName]", 1000)
      .setValue("input[name=lastName]", lastName)
      .pause(500);

    return this;
  };

  this.fillEmail = function(email) {
    browser
      .waitForElementPresent("input[name=email]", 1000)
      .setValue("input[name=email]", email)
      .pause(500);

    return this;
  };

  this.fillUsername = function(username) {
    browser
      .waitForElementPresent("#content input[name=username]", 1000)
      .setValue("#content input[name=username]", username)
      .pause(500);

    return this;
  };

  this.fillPassword = function(password) {
    browser
      .waitForElementPresent("#content input[name=password]", 1000)
      .setValue("#content input[name=password]", password)
      .pause(500);

    return this;
  };
};

