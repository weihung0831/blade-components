<script setup>
import ContactShell from './Shell.vue';
import ContactHours from './Hours.vue';
import ContactRoute from './Route.vue';
import ContactPerson from './Person.vue';

const routes = [
    { name: 'Warranty and repairs', lead: 'It arrived broken, it stopped working, or it has started making a noise it did not make in March.', person: 'Ines', reply: '47 min', window: '09:30–18:30 Mon–Fri', open: false, bring: ['serial', 'a ten-second clip'] },
    { name: 'Orders and delivery', lead: 'Where the parcel is, changing an address before it ships, and the ones customs has sat on for nine days.', person: 'Ping', reply: '2 h', window: '09:00–18:00 Mon–Sat', open: false, bring: ['order number'] },
    { name: 'Dealers and wholesale', lead: 'Terms start at six machines a month. Below that you are better off buying from us at the retail price, and we will say so.', person: 'Ines', reply: '1 day', window: 'Tue and Thu', open: false, bring: ['shop name', 'city', 'volume'] },
    { name: 'Press and everything else', lead: 'Photographs, a loan machine for a review, or a question that fits none of the boxes above.', person: 'Sofia', reply: '3 days', window: 'when the bench is quiet', open: false, bring: ['your deadline'] },
];

const people = [
    { name: 'Ines Marto', initials: 'IM', role: 'builds them', handles: 'Warranty, repairs, dealer terms. She assembled about a third of the machines in the field, which is why she answers noise questions in one line.', hours: 'at the bench 09:30–18:30' },
    { name: 'Ping Hsu', initials: 'PH', role: 'ships them', handles: 'Orders, couriers, customs paperwork, and the address you meant to change on Tuesday.', hours: 'at the desk 09:00–18:00, Saturdays too' },
    { name: 'Tomas Ferreira', initials: 'TF', role: 'fixes them', handles: 'Anything that has to come back to the counter. He is the one who calls you before touching a machine that is out of warranty.', hours: 'counter Tue and Thu afternoons' },
    { name: 'Sofia Reis', initials: 'SR', role: 'writes it down', handles: 'Press, the help centre, and the manual. If your question turns into a page on this site, she wrote it.', hours: 'part time, Mon Wed Fri' },
];

const ready = [
    { what: 'The serial', where: 'A plate under the base, six digits after NS-B. It tells us which batch, which burr set, and whether yours is one of the forty with the noisy collar.' },
    { what: 'The order number', where: 'On the confirmation mail, shaped NS-2026-0000. Without it we are searching by your surname and there are four of you.' },
    { what: 'A ten-second clip', where: 'Point a phone at the machine and run it empty from 1 to 16. Ten seconds of that beats three paragraphs describing a sound.' },
];

const cannot = [
    'Tell you a shipping date for a batch that has not been built. We build 40 at a time and we will not guess.',
    'Take a card over the phone. Ping will send a link instead, and it will come from this domain.',
    'Service a machine that came from an auction site without a serial. We have no way to know what is inside it.',
];
</script>

<template>
    <ContactShell active="The desk">
        <template #toolbar>
            <ContactHours zone="Taipei" time="04:12" :cursor="4.2" state="shut" :windows="[[9.5, 18.5]]" note="Mail is read 09:30–18:30, Mon–Fri" />
        </template>

        <div class="mx-auto max-w-4xl">
            <h1 class="text-lg font-semibold tracking-tight text-cream">Four ways in, and a person at the end of each</h1>
            <p class="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                There is no queue and no ticket system pretending to be one. Pick the line that fits and it lands in the mailbox
                of somebody who can do something about it. Everything below is measured, not promised — the median is what
                actually happened over the last ninety days.
            </p>

            <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
                <ContactRoute v-for="(entry, index) in routes" :key="entry.name" v-bind="entry" :active="index === 0" />
            </div>

            <div class="mt-10 grid grid-cols-1 gap-8 lg:grid-cols-[1.4fr_1fr]">
                <section>
                    <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Have these to hand</h2>
                    <p class="mt-2 max-w-lg text-[13px]/6 text-zinc-500">
                        Two of the three are on the machine or in your mail already. Sending them in the first letter is worth
                        about half a day, because the alternative is us asking and you answering while the bench is shut.
                    </p>

                    <div class="mt-4 divide-y divide-white/5 border-y border-white/5">
                        <div v-for="entry in ready" :key="entry.what" class="flex gap-4 py-3.5">
                            <span class="w-28 shrink-0 text-[13px] text-zinc-300">{{ entry.what }}</span>
                            <span class="text-[12px]/5 text-zinc-500">{{ entry.where }}</span>
                        </div>
                    </div>

                    <h2 class="mt-8 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What we will not do by mail</h2>
                    <ul class="mt-3 space-y-2.5">
                        <li v-for="line in cannot" :key="line" class="flex gap-2.5 text-[12px]/5 text-zinc-500">
                            <span class="mt-1.5 size-1 shrink-0 rounded-full bg-amber-400/60"></span>
                            <span>{{ line }}</span>
                        </li>
                    </ul>
                </section>

                <aside>
                    <h2 class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Who reads it</h2>

                    <div class="mt-4 space-y-5">
                        <ContactPerson v-for="entry in people" :key="entry.name" v-bind="entry" />
                    </div>

                    <div class="mt-6 rounded-xl border border-white/8 bg-ink-900 p-4">
                        <p class="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">By telephone</p>
                        <p class="mt-2 font-mono text-base text-cream">+886 2 2765 4418</p>
                        <p class="mt-1.5 text-[12px]/5 text-zinc-500">
                            Tuesday to Thursday, 14:00 to 17:00, and only then. The rest of the week it rings next to a lathe
                            nobody can hear over. A letter beats a voicemail every time.
                        </p>

                        <div class="mt-3.5 border-t border-white/5 pt-3">
                            <ContactHours zone="Taipei" time="04:12" :cursor="4.2" state="shut" :windows="[[14, 17]]" note="Tue–Thu only" />
                        </div>
                    </div>
                </aside>
            </div>

            <section class="mt-10 flex flex-wrap items-center gap-x-6 gap-y-3 rounded-xl border border-jade-500/25 bg-jade-500/5 p-4">
                <div class="min-w-0 flex-1">
                    <p class="text-[13px] text-cream">Six letters in ten already have an answer on this site</p>
                    <p class="mt-1 text-[12px]/5 text-zinc-500">
                        Not a brush-off — it is the difference between reading it now and waiting until 09:30 tomorrow for the
                        same sentence, typed again by hand.
                    </p>
                </div>
                <a
                    href="/templates/faq/screens/questions"
                    target="_top"
                    class="shrink-0 rounded-lg border border-white/12 px-3 py-1.5 text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                >Open the help centre</a>
            </section>
        </div>
    </ContactShell>
</template>
