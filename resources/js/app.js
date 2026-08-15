/**
 * Sidebar scrollspy: highlights the category link whose section is
 * currently in view. Links opt in with [data-spy-link], sections with
 * [data-spy-section]; the active link carries a bare [data-active]
 * attribute styled via Tailwind's data-active: variant.
 */
const backToTop = document.querySelector('[data-back-to-top]');

if (backToTop) {
    const toggle = () => backToTop.toggleAttribute('data-visible', window.scrollY > 600);

    window.addEventListener('scroll', toggle, { passive: true });
    toggle();

    backToTop.addEventListener('click', () => {
        const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        window.scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' });
    });
}

const spySections = [...document.querySelectorAll('[data-spy-section]')];
const spyLinks = [...document.querySelectorAll('[data-spy-link]')];

if (spySections.length && spyLinks.length) {
    const visible = new Set();

    const activate = (id) => {
        spyLinks.forEach((link) => link.toggleAttribute('data-active', link.getAttribute('href') === `#${id}`));
    };

    const update = () => {
        const atBottom = window.innerHeight + window.scrollY >= document.documentElement.scrollHeight - 4;
        const current = atBottom ? spySections.at(-1) : spySections.find((section) => visible.has(section.id));

        if (current) {
            activate(current.id);
        }
    };

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                visible[entry.isIntersecting ? 'add' : 'delete'](entry.target.id);
            });
            update();
        },
        { rootMargin: '-96px 0px -55% 0px' },
    );

    spySections.forEach((section) => observer.observe(section));
    window.addEventListener('scroll', update, { passive: true });
    activate(spySections[0].id);
}
