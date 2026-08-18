const LABELS = {
    to: 'billed to',
    ship: 'shipped to',
    from: 'from',
};

export function InvoiceParty({ role = 'to', name, taxId, lines = [], contact, note }) {
    return (
        <div className="min-w-0">
            <p className="font-mono text-[10px] tracking-wider text-zinc-700 uppercase">{LABELS[role] ?? role}</p>

            <p className="mt-2 text-[14px] font-medium tracking-tight text-cream">{name}</p>

            {taxId && <p className="mt-1 font-mono text-[10px] text-jade-300">統一編號 {taxId}</p>}

            {lines.length > 0 && (
                <p className="mt-2 text-[11px]/5 text-zinc-500">
                    {lines.map((line, index) => (
                        <span key={line}>
                            {line}
                            {index < lines.length - 1 && <br />}
                        </span>
                    ))}
                </p>
            )}

            {contact && <p className="mt-2 font-mono text-[10px] text-zinc-600">{contact}</p>}

            {note && <p className="mt-2 border-l border-white/10 pl-2.5 text-[11px]/5 text-zinc-600">{note}</p>}
        </div>
    );
}
