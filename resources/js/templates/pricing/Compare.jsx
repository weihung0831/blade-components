import { PricingShell } from './Shell';

const tiers = [
    { name: 'Launch', monthly: '$79', annual: '$66', cta: 'Start trial' },
    { name: 'Scale', monthly: '$1,240', annual: '$1,041', cta: 'Start on Scale', featured: true },
    { name: 'Enterprise', monthly: 'Custom', annual: 'Custom', cta: 'Talk to sales' },
];

const groups = [
    { label: 'Storefronts', rows: [
        { label: 'Live storefronts', values: ['1', 'Unlimited', 'Unlimited'] },
        { label: 'Sandbox storefronts', values: ['2', '10', 'Unlimited'] },
        { label: 'Products per storefront', values: ['5,000', '250,000', 'Set in contract'] },
        { label: 'Custom domains', values: ['1', 'Unlimited', 'Unlimited'] },
        { label: 'Checkout branding', note: 'logo, colours, and the receipt', values: [false, true, true] },
    ] },
    { label: 'Platform limits', rows: [
        { label: 'API calls', note: 'then $0.40 per extra 10k', values: ['250k / mo', '12M / mo', 'Set in contract'] },
        { label: 'Rate limit', values: ['20 req/s', '200 req/s', 'Negotiated'] },
        { label: 'Asset storage', note: 'then $0.09 per extra GB', values: ['50 GB', '1 TB', 'Set in contract'] },
        { label: 'Bandwidth', note: 'then $0.05 per extra GB', values: ['250 GB', '5 TB', 'Set in contract'] },
        { label: 'Webhook events', note: 'then $2 per extra 100k', values: ['100k / mo', '1M / mo', 'Set in contract'] },
        { label: 'Log retention', values: ['30 days', '1 year', '7 years'] },
    ] },
    { label: 'Team and access', rows: [
        { label: 'Seats included', values: ['5', '10 minimum', '500 floor'] },
        { label: 'Price per extra seat', values: ['$6 / mo', '$12 / mo', 'Quoted'] },
        { label: 'Roles', values: ['3 fixed', '8 fixed', 'Custom scopes'] },
        { label: 'SAML SSO', values: [false, true, true] },
        { label: 'SCIM provisioning', note: 'deprovision on the HR system, not here', values: [false, false, true] },
        { label: 'Server API keys', values: ['3', '25', 'Unlimited'] },
        { label: 'Audit log', values: [false, '1 year', '7 years, exportable'] },
    ] },
    { label: 'Regions and data', rows: [
        { label: 'Regions', values: ['ap-1', 'ap-1 · sfo-2 · fra-1', 'Dedicated'] },
        { label: 'Data residency clause', values: [false, true, true] },
        { label: 'Backups', values: ['Daily, 7 days', 'Hourly, 35 days', 'Hourly, contract'] },
        { label: 'Point-in-time restore', values: [false, true, true] },
        { label: 'VPC peering, private link', values: [false, false, true] },
    ] },
    { label: 'Support and terms', rows: [
        { label: 'Uptime', values: ['99.9% target', '99.95% with credits', '99.99% with credits'] },
        { label: 'First response', values: ['Next business day', '4 hours', '1 hour, around the clock'] },
        { label: 'Named solutions engineer', values: [false, false, true] },
        { label: 'MSA and DPA', values: ['Standard', 'Standard', 'Redlines welcome'] },
        { label: 'Invoicing', values: ['Card', 'Card or ACH', 'PO, net-30'] },
        { label: 'Security questionnaire', note: 'returned inside 10 business days', values: [false, true, true] },
    ] },
];

const rowCount = groups.reduce((total, group) => total + group.rows.length, 0);

export function PricingCompare() {
    return (
        <PricingShell
            active="Compare"
            title="Every row, so you can find the one you came for."
            description={`The ${rowCount} things that differ between the three plans, grouped the way buyers ask about them. Included limits are per workspace, per month, unless the row says otherwise.`}
        >
            <div className="overflow-x-auto lg:overflow-x-visible">
                <table className="w-full min-w-[52rem] border-separate border-spacing-0 text-left">
                    <thead>
                        <tr>
                            <th scope="col" className="sticky left-0 z-20 w-[30%] border-b border-white/8 bg-ink-950 px-4 py-4 align-bottom lg:top-14">
                                <span className="font-mono text-[10px] tracking-wider text-zinc-600 uppercase">Compared</span>
                            </th>

                            {tiers.map((tier) => (
                                <th
                                    key={tier.name}
                                    scope="col"
                                    className={`z-10 border-b bg-ink-950 px-4 py-4 align-bottom lg:sticky lg:top-14 ${tier.featured ? "relative isolate border-jade-500/40 before:absolute before:inset-0 before:-z-10 before:bg-jade-500/6 before:content-['']" : 'border-white/8'}`}
                                >
                                    <div className="flex flex-wrap items-baseline gap-x-2 gap-y-1">
                                        <span className={`text-sm font-semibold ${tier.featured ? 'text-jade-300' : 'text-cream'}`}>{tier.name}</span>
                                        <span className="font-mono text-[11px] text-zinc-600">
                                            <span className="group-data-[cycle=annual]/shell:hidden">{tier.monthly}</span>
                                            <span className="hidden group-data-[cycle=annual]/shell:inline">{tier.annual}</span>
                                        </span>
                                    </div>
                                    <a href="#" className="mt-2 inline-block font-mono text-[10px] text-jade-400 transition-colors duration-150 hover:text-jade-300">{tier.cta} →</a>
                                </th>
                            ))}
                        </tr>
                    </thead>

                    {groups.map((group) => (
                        <tbody key={group.label}>
                            <tr>
                                <th scope="colgroup" colSpan={4} className="border-b border-white/5 bg-ink-900 px-4 py-2 font-mono text-[10px] tracking-wider text-zinc-500 uppercase">{group.label}</th>
                            </tr>

                            {group.rows.map((row) => (
                                <tr key={row.label}>
                                    <th scope="row" className="sticky left-0 z-10 border-b border-white/5 bg-ink-950 px-4 py-3 align-top font-normal">
                                        <span className="block text-[13px] text-zinc-300">{row.label}</span>
                                        {row.note && <span className="mt-0.5 block font-mono text-[10px] text-zinc-600">{row.note}</span>}
                                    </th>

                                    {row.values.map((value, index) => (
                                        <td
                                            key={index}
                                            className={`border-b px-4 py-3 align-top ${tiers[index].featured ? 'border-jade-500/20 bg-jade-500/6' : 'border-white/5'}`}
                                        >
                                            {value === true && (
                                                <svg className="size-3.5 text-jade-400" viewBox="0 0 12 12" fill="none" role="img" aria-label="Included">
                                                    <path d="M2 6.5 4.5 9 10 3" stroke="currentColor" strokeWidth="1.6" strokeLinecap="round" strokeLinejoin="round"/>
                                                </svg>
                                            )}
                                            {value === false && <span className="block h-3.5 w-3 border-b border-white/15" role="img" aria-label="Not included" />}
                                            {typeof value === 'string' && <span className="text-[13px] text-zinc-400">{value}</span>}
                                        </td>
                                    ))}
                                </tr>
                            ))}
                        </tbody>
                    ))}
                </table>
            </div>

            <div className="mt-10 grid gap-5 sm:grid-cols-3">
                <div className="rounded-2xl border border-white/8 bg-ink-900 p-5 sm:col-span-2">
                    <p className="font-mono text-[10px] tracking-wider text-jade-400 uppercase">What the limits mean in practice</p>
                    <p className="mt-3 text-[13px]/6 text-zinc-400">
                        A storefront doing 40k orders a month sits around 6M API calls and 2 TB of bandwidth, well inside Scale.
                        The row that pushes most merchants up is not traffic, it is seats: warehouse and support staff each need one, and the count creeps.
                    </p>
                </div>

                <div className="flex flex-col justify-between rounded-2xl border border-white/8 bg-ink-900 p-5">
                    <p className="text-[13px]/6 text-zinc-400">Need a row that is not here, or one written differently?</p>
                    <a href="/templates/pricing/screens/enterprise" target="_top" className="mt-4 font-mono text-[11px] text-jade-400 transition-colors duration-150 hover:text-jade-300">Ask for a quote →</a>
                </div>
            </div>
        </PricingShell>
    );
}
