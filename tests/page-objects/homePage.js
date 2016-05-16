module.exports = function(browser) {

  this.goTo = function() {
    browser
      .url('http://localhost:5000')
      .waitForElementVisible('body', 1000);

    return this;
  };

  this.goToNewsOne = function() {
    browser
      .click('#new1 a')
      .pause(500);

    return this;
  };

};

