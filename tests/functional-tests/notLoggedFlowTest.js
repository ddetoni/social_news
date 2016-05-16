module.exports = {
  'User not logged flow' : function (browser) {
    var newsTitle = "Mais uma noticia";
    var newsContent = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae ex vel arcu placerat elementum. Maecenas pharetra finibus magna, a fermentum nulla pharetra sit amet. Donec iaculis quam augue, id sodales enim vehicula nec. Etiam pellentesque blandit ultrices. Integer pellentesque ultricies felis, a dictum orci eleifend sit amet. Pellentesque ornare nisi ac augue varius commodo id nec lectus. Cras porta erat in lectus ornare egestas. Donec eu egestas libero. Aliquam hendrerit justo laoreet elit placerat dictum. Donec ac consectetur est. Morbi gravida a quam ac bibendum. Donec eu diam ex. Praesent vehicula eros in dui sollicitudin, eu facilisis sapien blandit. Aliquam varius ligula sit amet diam cursus, nec ornare erat condimentum. Proin sit amet eros pulvinar, aliquet est ac, commodo eros. Fusce hendrerit odio in hendrerit fermentum. Etiam non lacinia lorem. Vestibulum sollicitudin tortor ex, eu sagittis sapien hendrerit eget. Sed et purus efficitur ex gravida efficitur ac sit amet dolor. Donec eu dolor vel lacus tristique interdum. Suspendisse eu purus ac diam dictum lacinia. Morbi pharetra ex lobortis, pulvinar ex eu, viverra lorem.";

    var homePage = browser.page.homePage();
    var newsPage = browser.page.newsPage();

    homePage
      .goTo()
      .goToNewsOne();

    newsPage
      .assertThatTitleIs(newsTitle)
      .assertThatContentIs(newsContent);

    browser
      .end();
  }
};
