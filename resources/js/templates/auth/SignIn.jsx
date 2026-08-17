import { AuthShell } from './Shell';
import { AuthProviders } from './Providers';
import { UiAvatar } from '../../components/ui/data-display/Avatar';
import { UiFloatLabel } from '../../components/ui/forms/FloatLabel';
import { UiCheckbox } from '../../components/ui/forms/Checkbox';
import { UiSeparator } from '../../components/ui/data-display/Separator';
import { UiButton } from '../../components/ui/actions/Button';

const to = (screen) => `/templates/auth/screens/${screen}`;

export function AuthSignIn() {
    return (
        <AuthShell
            title="Sign in to wharf"
            subtitle="Your account works across every workspace you've been invited to."
            action={
                <>
                    <span className="text-zinc-500">No account?</span>
                    <a href={to('sign-up')} target="_top" className="font-medium text-jade-400 underline-offset-4 transition-colors duration-150 hover:text-jade-300 hover:underline">Start a trial</a>
                </>
            }
        >
            <div className="flex items-center gap-2.5 rounded-lg border border-white/10 bg-ink-950 px-3 py-2.5">
                <UiAvatar initials="NB" size="sm" />
                <div className="min-w-0">
                    <p className="truncate text-[13px] text-zinc-200">Northbeam Supply</p>
                    <p className="truncate font-mono text-[11px] text-zinc-600">northbeam.wharf.app</p>
                </div>
                <button type="button" className="ml-auto shrink-0 font-mono text-[11px] text-zinc-500 transition-colors duration-150 hover:text-cream">Switch</button>
            </div>

            <AuthProviders className="mt-4" />

            <UiSeparator label="or" className="my-5" />

            <form className="flex flex-col gap-3">
                <UiFloatLabel label="Work email" type="email" name="email" autoComplete="email" />
                <UiFloatLabel label="Password" type="password" name="password" autoComplete="current-password" />

                <div className="mt-0.5 flex items-center justify-between gap-3">
                    <UiCheckbox label="Keep me signed in" />
                    <a href={to('reset')} target="_top" className="shrink-0 text-[13px] text-jade-400 underline-offset-4 transition-colors duration-150 hover:text-jade-300 hover:underline">Forgot password?</a>
                </div>

                <UiButton className="mt-2 w-full">Sign in</UiButton>
            </form>

            <p className="mt-4 text-center font-mono text-[11px] text-zinc-600">
                Owners require a{' '}
                <a href={to('two-factor')} target="_top" className="text-zinc-500 underline decoration-white/20 underline-offset-4 transition-colors duration-150 hover:text-cream">second factor</a>
                {' '}on new devices
            </p>
        </AuthShell>
    );
}
