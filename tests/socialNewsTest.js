module.exports = {
  'Social News Test' : function (browser) {
    browser
      .url('http://localhost:5000')
      .waitForElementVisible('body', 1000)
      .assert.containsText('#header', 'Social News')
      .end();
  }
};
