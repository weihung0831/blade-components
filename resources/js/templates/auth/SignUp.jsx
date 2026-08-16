import { AuthShell } from './Shell';
import { AuthProviders } from './Providers';
import { UiFloatLabel } from '../../components/ui/FloatLabel';
import { UiInputGroup } from '../../components/ui/InputGroup';
import { UiPassword } from '../../components/ui/Password';
import { UiCheckbox } from '../../components/ui/Checkbox';
import { UiSeparator } from '../../components/ui/Separator';
import { UiButton } from '../../components/ui/Button';

const to = (screen) => `/templates/auth/screens/${screen}`;

export function AuthSignUp() {
    return (
        <AuthShell
            title="Create your workspace"
            subtitle="Fourteen days on the Scale trial. Four hundred seats, no card up front."
            action={
                <>
                    <span className="text-zinc-500">Already on wharf?</span>
                    <a href={to('sign-in')} target="_top" className="font-medium text-jade-400 underline-offset-4 transition-colors duration-150 hover:text-jade-300 hover:underline">Sign in</a>
                </>
            }
        >
            <AuthProviders note="SSO after setup" />

            <UiSeparator label="or" className="my-5" />

            <form className="flex flex-col gap-3">
                <UiFloatLabel label="Full name" name="name" autoComplete="name" />
                <UiFloatLabel label="Work email" type="email" name="email" autoComplete="email" />

                <div>
                    <UiInputGroup suffix=".wharf.app">
                        <input type="text" name="workspace" placeholder="northbeam" autoComplete="off" />
                    </UiInputGroup>
                    <p className="mt-1.5 font-mono text-[11px] text-zinc-600">Your tenant URL. Owners can move it later.</p>
                </div>

                <UiPassword label="Password" meter className="w-full!" />

                <UiCheckbox className="mt-1" label="I agree to the terms and the data processing addendum" description="Product mail once a month at most. Security notices always." />

                <UiButton className="mt-2 w-full">Create workspace</UiButton>
            </form>

            <div className="mt-4 flex items-center justify-between font-mono text-[11px] text-zinc-600">
                <span>Data region · ap-1 (Taipei)</span>
                <button type="button" className="transition-colors duration-150 hover:text-cream">Change</button>
            </div>
        </AuthShell>
    );
}
