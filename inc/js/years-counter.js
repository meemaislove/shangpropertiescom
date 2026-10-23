(function () {
  var FOUNDED = { year: 1987, month: 10, day: 20 };

  // One-time early switch: show 39 from Oct 15, 2026 (normal rule gives 39 from Oct 20)
  var EARLY = { year: 2026, month: 10, day: 15, years: 39 };

  function manilaParts(date) {
    var parts = new Intl.DateTimeFormat('en-CA', {
      timeZone: 'Asia/Manila',
      year: 'numeric', month: '2-digit', day: '2-digit'
    }).formatToParts(date);
    var o = {};
    parts.forEach(function (p) { o[p.type] = parseInt(p.value, 10); });
    return o;
  }

  function getYears(date) {
    var d = manilaParts(date || new Date());
    var years = d.year - FOUNDED.year;
    var beforeAnniversary =
      d.month < FOUNDED.month ||
      (d.month === FOUNDED.month && d.day < FOUNDED.day);
    if (beforeAnniversary) years -= 1;

    // Apply the early override only while it's still ahead of the normal result
    var pastEarly =
      d.year > EARLY.year ||
      (d.year === EARLY.year && (d.month > EARLY.month ||
        (d.month === EARLY.month && d.day >= EARLY.day)));
    if (pastEarly) years = Math.max(years, EARLY.years);

    return years;
  }

  // Exposed for console testing
  window.shangGetYears = getYears;

  document.addEventListener('DOMContentLoaded', function () {
    var body = document.body;
    if (!body.classList.contains('home') && !body.classList.contains('page-id-84')) return;

    var date = new Date();

    // Staging/admin-only fake date: ?fakedate=2027-10-20
    if (body.classList.contains('logged-in')) {
      var fake = new URLSearchParams(window.location.search).get('fakedate');
      if (fake && /^\d{4}-\d{2}-\d{2}$/.test(fake)) {
        date = new Date(fake + 'T12:00:00+08:00');
      }
    }

    var el = document.querySelector(
      'section.homepage-years .years-counter span.count-main'
    );
    if (el) el.textContent = getYears(date);
  });
})();