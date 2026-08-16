import { useState } from 'react';

const formatSize = (bytes) => {
    if (bytes >= 1048576) {
        return `${(bytes / 1048576).toFixed(1)} MB`;
    }

    if (bytes >= 1024) {
        return `${Math.round(bytes / 1024)} KB`;
    }

    return `${bytes} B`;
};

export function UiFileUpload({
    hint = '10 MB max',
    multiple = false,
    compact = false,
    onChange = () => {},
    className = '',
    ...props
}) {
    const [files, setFiles] = useState([]);
    const [dragover, setDragover] = useState(false);

    const summary = files.length === 0 ? 'No file selected' : files.length === 1 ? files[0].name : `${files.length} files`;

    const update = (next) => {
        setFiles(next);
        onChange(next);
    };

    const addFiles = (list) => {
        update(multiple ? [...files, ...list] : [...list].slice(0, 1));
    };

    const removeFile = (index) => {
        update(files.filter((file, i) => i !== index));
    };

    const dropHandlers = {
        onDragOver: (event) => {
            event.preventDefault();
            setDragover(true);
        },
        onDragLeave: (event) => {
            event.preventDefault();
            setDragover(false);
        },
        onDrop: (event) => {
            event.preventDefault();
            setDragover(false);
            addFiles(event.dataTransfer.files);
        },
    };

    return (
        <div className={[compact ? 'w-64' : 'w-72', className].filter(Boolean).join(' ')} {...props}>
            {compact ? (
                <label
                    className={`flex cursor-pointer items-center gap-3 rounded-lg border bg-ink-950 p-1.5 transition-colors duration-150 focus-within:border-jade-500 ${dragover ? 'border-jade-500' : 'border-white/10'}`}
                    {...dropHandlers}
                >
                    <input type="file" multiple={multiple} className="sr-only" onChange={(event) => addFiles(event.target.files)} />
                    <span className="flex h-7 shrink-0 items-center rounded-md border border-white/10 px-2.5 text-xs font-medium text-zinc-300 transition-colors duration-150 hover:border-white/25">Choose file</span>
                    <span className={`truncate text-xs ${files.length > 0 ? 'text-zinc-300' : 'text-zinc-600'}`}>{summary}</span>
                </label>
            ) : (
                <label
                    className={`grid cursor-pointer place-items-center gap-1.5 rounded-xl border border-dashed px-4 py-8 text-center transition-colors duration-150 focus-within:border-jade-500 ${dragover ? 'border-jade-500 bg-jade-500/5' : 'border-white/15 bg-ink-950/50 hover:border-white/30'}`}
                    {...dropHandlers}
                >
                    <input type="file" multiple={multiple} className="sr-only" onChange={(event) => addFiles(event.target.files)} />
                    <svg className="size-5 text-zinc-500" viewBox="0 0 16 16" fill="none"><path d="M8 10.5v-7M5 6l3-2.5L11 6M3 12.5h10" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/></svg>
                    <p className="text-sm text-zinc-400">Drop {multiple ? 'files' : 'a file'} here</p>
                    <p className="text-xs text-zinc-600">or <span className="text-jade-400">browse</span> · {hint}</p>
                </label>
            )}
            {files.length > 0 && (
                <ul className="mt-2 flex flex-col gap-1.5">
                    {files.map((file, index) => (
                        <li key={`${file.name}-${index}`} className="flex items-center gap-2.5 rounded-lg border border-white/10 bg-ink-950 py-2 pr-2 pl-3">
                            <svg className="size-3.5 shrink-0 text-zinc-500" viewBox="0 0 16 16" fill="none"><path d="M9.5 1.5h-5a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V4.5l-3-3Z" stroke="currentColor" strokeWidth="1.3" strokeLinejoin="round"/><path d="M9.5 1.5v3h3" stroke="currentColor" strokeWidth="1.3" strokeLinejoin="round"/></svg>
                            <span className="min-w-0 flex-1 truncate text-xs text-zinc-300">{file.name}</span>
                            <span className="shrink-0 font-mono text-[10px] text-zinc-600">{formatSize(file.size)}</span>
                            <button type="button" aria-label="Remove file" onClick={() => removeFile(index)} className="grid size-5 shrink-0 cursor-pointer place-items-center rounded text-zinc-600 transition-colors duration-150 hover:bg-white/5 hover:text-cream">
                                <svg className="size-3" viewBox="0 0 12 12" fill="none"><path d="m3 3 6 6M9 3l-6 6" stroke="currentColor" strokeWidth="1.4" strokeLinecap="round"/></svg>
                            </button>
                        </li>
                    ))}
                </ul>
            )}
        </div>
    );
}
