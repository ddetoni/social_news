module.exports = function(browser) {

  this.assertThatTitleIs = function(title) {
    browser.expect.element("#new h3").text.to.equal(title);

    return this;
  };

  this.assertThatContentIs = function(content) {
    browser.expect.element("#new p").text.to.equal(content);

    return this;
  };

  this.assertThatFirstCommentIs = function(comment) {
    browser.expect.element("#comments_list div").text.to.contain(comment);

    return this;
  }

};
