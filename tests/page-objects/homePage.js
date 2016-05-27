module.exports = function(browser) {

  this.goTo = function() {
    browser
      .url('http://localhost:5000')
      .waitForElementVisible('body', 1000);

    return this;
  };

  this.goToPanel = function() {
    browser
      .click('#panel')
      .pause(500);

    return this;
  };

  this.goToNewsOne = function() {
    browser
      .click('#new1 a')
      .pause(500);

    return this;
  };

  this.doLogin = function(username, password) {
    browser
      .waitForElementPresent("#login input[name=username]", 1000)
      .setValue("#login input[name=username]", username)
      .waitForElementPresent("#login input[name=password]", 1000)
      .setValue("#login input[name=password]", password)
      .click("#login button");

    browser.expect.element("#login").text.to.contains("User: " + username);

    return this;
  };

};

