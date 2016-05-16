module.exports = {
  'User not logged flow' : function (browser) {
    var homePage = browser.page.homePage();
    var newsPage = browser.page.newsPage();

    homePage
      .goTo()
      .goToNewsOne();

    newsPage
      .assertThatTitleIs("Mais uma noticia");

    browser
      .end();
  }
};
