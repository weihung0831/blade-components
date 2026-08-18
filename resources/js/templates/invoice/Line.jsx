export function InvoiceLine({ code, description, note, qty = 1, unit, price, amount, tax, showTax = false }) {
    return (
        <tr className="border-t border-white/5 align-top">
            <td className="py-3 pr-3 pl-6 sm:pl-8">
                <span className="block text-[13px]/5 text-cream">{description}</span>
                {note && <span className="mt-1 block max-w-md text-[11px]/5 text-zinc-600">{note}</span>}
                {code && <span className="mt-1 block font-mono text-[10px] text-zinc-700">{code}</span>}
            </td>

            <td className="px-3 py-3 text-right font-mono text-[12px] tabular-nums text-zinc-400 whitespace-nowrap">
                {qty}{unit && <span className="text-zinc-700"> {unit}</span>}
            </td>

            <td className="px-3 py-3 text-right font-mono text-[12px] tabular-nums text-zinc-400 whitespace-nowrap">{price}</td>

            {showTax && <td className={`px-3 py-3 text-right font-mono text-[11px] whitespace-nowrap ${tax === '0%' ? 'text-amber-300' : 'text-zinc-600'}`}>{tax ?? '5%'}</td>}

            <td className="py-3 pr-6 pl-3 text-right font-mono text-[12px] tabular-nums text-cream whitespace-nowrap sm:pr-8">{amount}</td>
        </tr>
    );
}
