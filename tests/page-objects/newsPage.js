module.exports = function(browser) {

  this.assertThatTitleIs = function(title) {
    browser.expect.element("#new h3").text.to.equal(title);

    return this;
  };

};
