/**
 * Sidebar scrollspy: highlights the category link whose section is
 * currently in view. Links opt in with [data-spy-link], sections with
 * [data-spy-section]; the active link carries a bare [data-active]
 * attribute styled via Tailwind's data-active: variant.
 */
const themeToggle = document.querySelector('[data-theme-toggle]');

if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        const root = document.documentElement;

        if (root.dataset.theme === 'light') {
            delete root.dataset.theme;
            localStorage.setItem('theme', 'dark');
        } else {
            root.dataset.theme = 'light';
            localStorage.setItem('theme', 'light');
        }
    });
}

window.addEventListener('storage', (event) => {
    if (event.key !== 'theme') {
        return;
    }

    if (event.newValue === 'light') {
        document.documentElement.dataset.theme = 'light';
    } else {
        delete document.documentElement.dataset.theme;
    }
});

document.querySelectorAll('[data-copy-code]').forEach((button) => {
    const copyIcon = button.querySelector('[data-copy-icon]');
    const copiedIcon = button.querySelector('[data-copied-icon]');
    let resetTimer;

    button.addEventListener('click', async () => {
        await navigator.clipboard.writeText(button.dataset.copyCode);

        copyIcon.classList.add('hidden');
        copiedIcon.classList.remove('hidden');

        clearTimeout(resetTimer);
        resetTimer = setTimeout(() => {
            copyIcon.classList.remove('hidden');
            copiedIcon.classList.add('hidden');
        }, 1600);
    });
});

const codeTabGroups = document.querySelectorAll('[data-code-tabs]');

if (codeTabGroups.length > 0) {
    const activateCodeLanguage = (language) => {
        codeTabGroups.forEach((group) => {
            const buttons = [...group.querySelectorAll('[data-code-tab]')];
            const target = buttons.find((button) => button.dataset.codeTab.split(' ').includes(language));

            if (!target) {
                return;
            }

            buttons.forEach((button) => {
                if (button === target) {
                    button.dataset.active = '';
                } else {
                    delete button.dataset.active;
                }
            });

            group.querySelectorAll('[data-code-panel]').forEach((panel) => {
                panel.classList.toggle('hidden', !panel.dataset.codePanel.split(' ').includes(language));
            });
        });
    };

    document.querySelectorAll('[data-code-tab]').forEach((button) => {
        button.addEventListener('click', () => {
            const [language] = button.dataset.codeTab.split(' ');

            activateCodeLanguage(language);
        });
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
