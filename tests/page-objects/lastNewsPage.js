module.exports = function(browser) {

  this.goToRegister = function() {
    browser
      .click("#register_content > h5")
      .pause(500);

    return this;
  };

  this.assertThatTotalLastNewsIs = function(total) {
    browser.elements("css selector", "#lastNews", function(lastNews) {
      var assert = browser.assert;

      assert.equal(lastNews.value.length, total, "The total of last news did not match.");
    });

    return this;
  };
};
