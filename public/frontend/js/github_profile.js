var _createClass = function () {function defineProperties(target, props) {for (var i = 0; i < props.length; i++) {var descriptor = props[i];descriptor.enumerable = descriptor.enumerable || false;descriptor.configurable = true;if ("value" in descriptor) descriptor.writable = true;Object.defineProperty(target, descriptor.key, descriptor);}}return function (Constructor, protoProps, staticProps) {if (protoProps) defineProperties(Constructor.prototype, protoProps);if (staticProps) defineProperties(Constructor, staticProps);return Constructor;};}();function _classCallCheck(instance, Constructor) {if (!(instance instanceof Constructor)) {throw new TypeError("Cannot call a class as a function");}}function _possibleConstructorReturn(self, call) {if (!self) {throw new ReferenceError("this hasn't been initialised - super() hasn't been called");}return call && (typeof call === "object" || typeof call === "function") ? call : self;}function _inherits(subClass, superClass) {if (typeof superClass !== "function" && superClass !== null) {throw new TypeError("Super expression must either be null or a function, not " + typeof superClass);}subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } });if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass;} /*
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           Home : https://github.com/c0ncept/github-user-card
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           */

// var GITHUB_USER = 'Thuongkim';
var GITHUB_URL = 'https://api.github.com/users/';



Chart.defaults.global = {
  animation: true,
  animationSteps: 50,
  animationEasing: "easeOutBounce",
  scaleLabel: "<%=value%>",
  bezierCurve: true,
  bezierCurveTension: 1,
  scaleIntegersOnly: true,
  scaleBeginAtZero: false,
  maintainAspectRatio: false,
  onAnimationProgress: function onAnimationProgress() {},
  onAnimationComplete: function onAnimationComplete() {} };var


Repo = function (_React$Component) {_inherits(Repo, _React$Component);function Repo() {_classCallCheck(this, Repo);return _possibleConstructorReturn(this, (Repo.__proto__ || Object.getPrototypeOf(Repo)).apply(this, arguments));}_createClass(Repo, [{ key: 'render', value: function render()
    {var
      repo = this.props.repo;
      return (
        React.createElement('a', { className: 'repository', href: repo.html_url },
          React.createElement('div', { className: 'repo-info' },
            React.createElement('div', null, React.createElement('i', { className: 'fa fa-star' }),
              React.createElement('span', null), React.createElement('span', { className: 'title' }, repo.name)))));





    } }]);return Repo;}(React.Component);var



Card = function (_React$Component4) {_inherits(Card, _React$Component4);function Card() {_classCallCheck(this, Card);return _possibleConstructorReturn(this, (Card.__proto__ || Object.getPrototypeOf(Card)).apply(this, arguments));}_createClass(Card, [{ key: 'render', value: function render()
    {
      var reposData = this.props.repos.
      sort(function (a, b) {return b.stargazers_count - a.stargazers_count;}).
      slice(0, 1);
      var repos = reposData.
      map(function (r, i) {return React.createElement(Repo, { key: i, repo: r });});

      var starred = this.props.repos.
      reduce(function (p, c) {return p + Number(c.stargazers_count);}, 0);

      var forked = this.props.repos.
      reduce(function (p, c) {return p + Number(c.forks_count);}, 0);

      return (
        React.createElement('div', { className: 'card' },
          React.createElement('div', { className: 'header' },

            React.createElement('a', { className: 'userlink', href: this.props.user.html_url, target: '_blank' },
              this.props.user.login,
              React.createElement('i', { className: 'fa fa-link' })),


            React.createElement('div', { className: 'avatar' },
              React.createElement('img', { src: this.props.user.avatar_url })),


            React.createElement('span', { className: 'repos-count' },
              this.props.user.public_repos),


            React.createElement('div', { className: 'userinfo' },
              React.createElement('h2', null, this.props.user.name || this.props.user.login),
              React.createElement('p', null, this.props.user.location))),


          React.createElement('div', { className: 'totals' },
            React.createElement('div', null,
              this.props.user.followers,
              React.createElement('div', { className: 'desc' }, 'Followers')),

            React.createElement('div', null,
              starred,
              React.createElement('div', { className: 'desc' }, 'Total stars')),

            React.createElement('div', null,
              forked,
              React.createElement('div', { className: 'desc' }, 'Times Forked'))),



          React.createElement('br', null), React.createElement('br', null),
          React.createElement('div', { className: 'super-line' }, 'TOP Rated'),
          React.createElement('div', { className: 'top-repos' },
            repos),

          React.createElement('br', null), React.createElement('br', null)));


    } }]);return Card;}(React.Component);var



Application = function (_React$Component5) {_inherits(Application, _React$Component5);
  function Application() {_classCallCheck(this, Application);var _this5 = _possibleConstructorReturn(this, (Application.__proto__ || Object.getPrototypeOf(Application)).call(this));

    _this5.state = { user: {}, repos: [] };
    _this5.loadGitHubUser(GITHUB_USER);return _this5;
  }_createClass(Application, [{ key: 'loadGitHubUser', value: function loadGitHubUser(

    user) {var _this6 = this;
      Promise.all([
      fetch(GITHUB_URL + user).then(function (r) {return r.json();}),
      fetch(GITHUB_URL + user + '/repos').then(function (r) {return r.json();}),
      fetch(GITHUB_URL + user + '/events?per_page=300').then(function (r) {return r.json();})]).
      then(function (resp) {
        _this6.setState({ user: resp[0], repos: resp[1], events: resp[2] });
      });
    } }, { key: 'render', value: function render()

    {
      var children = this.state.user.hasOwnProperty('login') ?
      React.createElement(Card, { user: this.state.user, repos: this.state.repos, events: this.state.events }) :
      React.createElement('div', { className: 'loading' }, React.createElement('span', null), React.createElement('span', null), React.createElement('span', null), React.createElement('span', null), React.createElement('span', null));

      return (
        React.createElement('div', { className: 'wrapper' },
          children));


    } }]);return Application;}(React.Component);


ReactDOM.render(React.createElement(Application, null),
document.getElementById('application'));