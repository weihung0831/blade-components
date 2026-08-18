import { useState } from 'react';
import { OnboardingShell } from './Shell';
import { OnboardingTask } from './Task';

const TASKS = [
    { label: 'Pick the region', why: 'Done on the second setup screen. It is on this list because it is the only setting that cannot be changed afterwards, so it gets said twice.', cost: '1 min', done: true, required: true },
    { label: 'A bank account for payouts', why: 'Orders can come in without it and the money sits with us. Nothing goes to a bank until this is here, and the first payout is seven days behind the first order anyway.', cost: '6 min', done: false, required: true },
    { label: 'An address customers can write to', why: 'Confirmed by clicking the link in the mail we sent to ana@kerouac.coffee. Without it, every order confirmation goes out from a no-reply nobody reads.', cost: 'done in 40 seconds', done: true, required: true },
    { label: 'Bring the catalog over', why: '387 products in, 19 rows left behind with a reason against each. The photos finished about an hour after the rest.', cost: '19 min', done: true, required: false },
    { label: 'Price your own freight', why: 'Until you do, orders use our default table, which is about 12% over what the courier charges you. That difference is yours, not ours, so it is worth an evening.', cost: '25 min', done: false, required: false },
    { label: 'Point kerouac.coffee at the shop', why: 'Two DNS records and a wait. The kerouac.nomadsupply.cc address keeps working forever either way, and half of all shops never bother.', cost: '10 min, then a day of waiting', done: false, required: false },
    { label: 'Read the refund policy you are shipping', why: 'Ticked because you accepted ours. It is a reasonable policy and it is not yours — the returns window in it is 14 days, which is longer than the law asks and shorter than what most roasters offer.', cost: '4 min to read', done: true, required: false },
    { label: 'Put somebody else on the shop', why: 'Two seats are in the plan and one of them is empty. It matters the first week you are ill.', cost: '3 min', done: false, required: false, moved: 'was on the required list until March' },
    { label: 'A photograph at the top of the shop', why: 'You uploaded the one of the roaster. Shops with a photo sell about a fifth more in their first month, which is a correlation we have never been able to untangle from simply caring.', cost: '2 min', done: true, required: false, moved: 'was on the required list until March' },
];

const FILTERS = [
    { key: 'all-tasks', label: 'All nine' },
    { key: 'yes', label: 'Holds the shop shut' },
    { key: 'no', label: 'Can wait' },
];

const SPELL = ['none', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];

export function OnboardingChecklist() {
    const [tasks, setTasks] = useState(TASKS);
    const [picked, setPicked] = useState('all-tasks');

    const toggle = (label) => setTasks((current) => current.map((task) => (task.label === label ? { ...task, done: !task.done } : task)));

    const shut = tasks.filter((task) => task.required);
    const rest = tasks.filter((task) => !task.required);
    const shutDone = shut.filter((task) => task.done).length;
    const done = tasks.filter((task) => task.done).length;
    const left = shut.length - shutDone;
    const closed = left > 0;

    const toolbar = (
        <div className="flex flex-wrap items-center gap-x-3 gap-y-2">
            {FILTERS.map((filter) => (
                <button
                    key={filter.key}
                    type="button"
                    data-active={picked === filter.key ? '' : undefined}
                    className="rounded-lg px-2.5 py-1 font-mono text-[11px] text-zinc-500 transition-colors duration-150 outline-none hover:bg-white/5 hover:text-cream focus-visible:ring-2 focus-visible:ring-jade-500/70 data-active:bg-jade-500/15 data-active:text-jade-300"
                    onClick={() => setPicked(filter.key)}
                >{filter.label}</button>
            ))}

            <span className="ml-auto font-mono text-[10px] text-zinc-600">{SPELL[done]} of nine done</span>
        </div>
    );

    return (
        <OnboardingShell active="What is left" step="payouts" skipped={['people']} interactive toolbar={toolbar}>
            <div className="mx-auto max-w-6xl">
                <h1 className="text-lg font-semibold tracking-tight text-cream">Nine things, and only three of them matter today</h1>
                <p className="mt-1.5 max-w-2xl text-[13px]/6 text-zinc-500">
                    Every onboarding checklist wants all nine ticked. This one sorts them by whether the shop can open without them,
                    says what it costs you to leave one alone, and admits which two were on the wrong list until somebody looked.
                </p>

                <div className="mt-6 grid grid-cols-1 gap-8 lg:grid-cols-[1.6fr_1fr]">
                    <section>
                        {picked !== 'no' && (
                            <div>
                                <div className="flex items-baseline justify-between gap-3">
                                    <h2 className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Holds the shop shut</h2>
                                    <span className="font-mono text-[10px] text-zinc-700">three</span>
                                </div>

                                <div className="mt-2.5 divide-y divide-white/5 overflow-hidden rounded-xl border border-amber-400/20 bg-ink-950">
                                    {shut.map((task) => <OnboardingTask key={task.label} {...task} onToggle={() => toggle(task.label)} />)}
                                </div>
                            </div>
                        )}

                        {picked !== 'yes' && (
                            <div className="mt-7">
                                <div className="flex items-baseline justify-between gap-3">
                                    <h2 className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Everything else</h2>
                                    <span className="font-mono text-[10px] text-zinc-700">six</span>
                                </div>

                                <div className="mt-2.5 divide-y divide-white/5 overflow-hidden rounded-xl border border-white/8 bg-ink-950">
                                    {rest.map((task) => <OnboardingTask key={task.label} {...task} onToggle={() => toggle(task.label)} />)}
                                </div>
                            </div>
                        )}
                    </section>

                    <aside>
                        <div className={`rounded-xl border p-4 ${closed ? 'border-amber-400/25 bg-amber-400/5' : 'border-jade-500/25 bg-jade-500/5'}`}>
                            <p className={`text-[13px] ${closed ? 'text-amber-300' : 'text-jade-300'}`}>
                                {closed ? `${SPELL[left]} thing${left === 1 ? '' : 's'} still hold${left === 1 ? 's' : ''} it shut` : 'Nothing is holding it shut'}
                            </p>
                            <p className="mt-1.5 text-[12px]/5 text-zinc-400">
                                {closed
                                    ? 'Everything else on the list can happen with customers already in the door.'
                                    : 'The rest of the list can wait until the shop is busy enough to make it worth doing.'}
                            </p>

                            <div className="mt-3 h-1.5 overflow-hidden rounded-full bg-white/8">
                                <div
                                    className={`h-full rounded-full transition-[width] duration-300 ${closed ? 'bg-amber-400/70' : 'bg-jade-500'}`}
                                    style={{ width: `${Math.round((shutDone / shut.length) * 100)}%` }}
                                ></div>
                            </div>
                            <p className="mt-1.5 font-mono text-[10px] text-zinc-600">{shutDone} of the {shut.length} required · {done} of {tasks.length} altogether</p>

                            <button
                                type="button"
                                disabled={closed}
                                className="mt-3 w-full rounded-lg bg-jade-500 py-2 text-[13px] font-medium text-ink-950 transition-colors duration-150 outline-none hover:bg-jade-400 focus-visible:ring-2 focus-visible:ring-jade-500/70 disabled:cursor-not-allowed disabled:bg-white/8 disabled:text-zinc-600"
                            >Open the shop</button>
                        </div>

                        <div className="mt-4 overflow-hidden rounded-xl border border-white/8 bg-ink-900">
                            <p className="border-b border-white/5 px-4 py-2.5 font-mono text-[10px] tracking-wider text-zinc-700 uppercase">What a customer sees right now</p>

                            <div className="p-4">
                                <div className="rounded-lg border border-white/8 bg-ink-950 p-3">
                                    <div className="flex items-center gap-2">
                                        <span className="size-5 rounded bg-jade-500/20"></span>
                                        <span className="text-[12px] text-cream">Kerouac Coffee</span>
                                        <span className="ml-auto font-mono text-[9px] text-zinc-700">kerouac.nomadsupply.cc</span>
                                    </div>

                                    <div className="mt-2.5 h-12 rounded bg-white/6"></div>

                                    <div className="mt-2 grid grid-cols-3 gap-1.5">
                                        {[1, 2, 3].map((tile) => (
                                            <div key={tile} className="rounded bg-white/4 p-1.5">
                                                <span className="block h-6 rounded bg-white/6"></span>
                                                <span className="mt-1 block h-1 w-2/3 rounded bg-white/10"></span>
                                                <span className="mt-1 block h-1 w-1/3 rounded bg-jade-500/40"></span>
                                            </div>
                                        ))}
                                    </div>
                                </div>

                                <p className="mt-3 text-[11px]/5 text-zinc-600">
                                    387 products, a photo, and a checkout that works. The freight line at the till still says our
                                    default rate, which is the one unticked thing a customer would actually notice.
                                </p>
                            </div>
                        </div>

                        <div className="mt-4 rounded-xl border border-white/8 bg-ink-900 p-4">
                            <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">Two things moved off the top list</p>
                            <p className="mt-2 text-[12px]/5 text-zinc-400">
                                Inviting somebody and uploading a photo used to hold the shop shut. In March we looked at 400 shops
                                that opened without either and could not find anything worse about them, so both moved down here.
                                The list got shorter rather than longer, which is the rarer direction.
                            </p>
                            <a
                                href="/templates/onboarding/screens/dropout"
                                target="_top"
                                className="mt-3 block rounded-lg border border-white/10 py-1.5 text-center text-[12px] text-zinc-300 transition-colors duration-150 hover:border-jade-500/60 hover:text-cream"
                            >What that changed</a>
                        </div>
                    </aside>
                </div>
            </div>
        </OnboardingShell>
    );
}
