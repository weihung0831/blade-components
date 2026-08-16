import { AuthShell } from './Shell';
import { UiAlert } from '../../components/ui/Alert';
import { UiInputOtp } from '../../components/ui/InputOtp';
import { UiCheckbox } from '../../components/ui/Checkbox';
import { UiSeparator } from '../../components/ui/Separator';
import { UiButton } from '../../components/ui/Button';

const to = (screen) => `/templates/auth/screens/${screen}`;

export function AuthTwoFactor() {
    return (
        <AuthShell
            title="Two-factor check"
            subtitle="Enter the six digits from your authenticator. We ask again whenever the device or region changes."
            action={
                <>
                    <span className="text-zinc-500">Signed in as</span>
                    <span className="font-mono text-[11px] text-zinc-400">dana@northbeam.co</span>
                </>
            }
        >
            <UiAlert variant="warning" title="New device">
                Chrome on macOS · Taipei · 203.0.113.42. If this wasn't you, change your password and end every session.
            </UiAlert>

            <form className="mt-6">
                <UiInputOtp length={6} label="Authenticator code" />

                <UiCheckbox className="mt-5" label="Trust this device for 30 days" description="Skips the code until the session or the region changes." />

                <UiButton className="mt-5 w-full">Verify and continue</UiButton>
            </form>

            <div className="mt-3 flex items-center justify-between font-mono text-[11px] text-zinc-600">
                <span>Code rotates every 30s</span>
                <button type="button" className="text-zinc-500 transition-colors duration-150 hover:text-cream">Send to SMS instead</button>
            </div>

            <UiSeparator className="my-6" />

            <div className="flex items-start gap-3">
                <svg className="mt-0.5 size-4 shrink-0 text-zinc-600" viewBox="0 0 16 16" fill="none"><path d="M6.5 9.5 3 13M4.5 11.5 3 13l.5 1.5M10.5 2.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Z" stroke="currentColor" strokeWidth="1.3" strokeLinecap="round" strokeLinejoin="round"/></svg>
                <div>
                    <p className="text-[13px] text-zinc-300">Lost the device?</p>
                    <p className="mt-1 text-xs/5 text-zinc-500">Use one of the ten recovery codes you saved at setup, or ask an owner to clear the factor from Settings → Security.</p>
                    <div className="mt-2.5 flex items-center gap-4 text-[13px]">
                        <button type="button" className="text-jade-400 underline-offset-4 transition-colors duration-150 hover:text-jade-300 hover:underline">Use a recovery code</button>
                        <a href={to('sign-in')} target="_top" className="text-zinc-400 underline-offset-4 transition-colors duration-150 hover:text-cream hover:underline">Back to sign in</a>
                    </div>
                </div>
            </div>
        </AuthShell>
    );
}
