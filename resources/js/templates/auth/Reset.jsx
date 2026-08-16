import { AuthShell } from './Shell';
import { UiFloatLabel } from '../../components/ui/FloatLabel';
import { UiAlert } from '../../components/ui/Alert';
import { UiButton } from '../../components/ui/Button';

const to = (screen) => `/templates/auth/screens/${screen}`;

export function AuthReset() {
    return (
        <AuthShell
            title="Reset your password"
            subtitle="We email a one-time link. It works once and expires after 60 minutes."
            action={
                <>
                    <span className="text-zinc-500">Remembered it?</span>
                    <a href={to('sign-in')} target="_top" className="font-medium text-jade-400 underline-offset-4 transition-colors duration-150 hover:text-jade-300 hover:underline">Sign in</a>
                </>
            }
        >
            <form className="flex flex-col gap-3">
                <UiFloatLabel label="Work email" type="email" name="email" autoComplete="email" />

                <UiButton className="w-full">Email me a link</UiButton>
            </form>

            <div className="mt-3 flex items-center justify-between font-mono text-[11px] text-zinc-600">
                <span>Last sent 30s ago to d••••@northbeam.co</span>
                <span className="text-zinc-500">Resend in 00:24</span>
            </div>

            <UiAlert variant="warning" title="SSO workspaces reset elsewhere" className="mt-6">
                Northbeam Supply signs in through Okta. Passwords live with your identity provider, so reset them there — this form only covers accounts on wharf's own login.
            </UiAlert>

            <div className="mt-6 rounded-xl border border-white/8 bg-ink-950 p-4">
                <p className="text-[13px] font-medium text-cream">Locked out entirely?</p>
                <p className="mt-1 text-xs/5 text-zinc-500">Any owner on the workspace can send a fresh invite or clear your second factor. Support only steps in when every owner is gone.</p>
                <div className="mt-3 flex items-center gap-4 text-[13px]">
                    <a href={to('two-factor')} target="_top" className="text-jade-400 underline-offset-4 transition-colors duration-150 hover:text-jade-300 hover:underline">Recover with a code</a>
                    <a href="#" className="text-zinc-400 underline-offset-4 transition-colors duration-150 hover:text-cream hover:underline">Contact support</a>
                </div>
            </div>
        </AuthShell>
    );
}
