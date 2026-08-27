import { Suspense } from "react";
import { EmailVerificationPage } from "@/components";

export const metadata = {
  title: "Verify Your Email — Henley Botanical Reserve",
  description: "Account activation link dispatched to your email inbox.",
};

function VerifyEmailContent({ searchParams }: { searchParams: Promise<{ email?: string }> }) {
  return (
    <Suspense fallback={<div className="min-h-screen bg-ivory" />}>
      <AsyncVerifyEmail searchParams={searchParams} />
    </Suspense>
  );
}

async function AsyncVerifyEmail({ searchParams }: { searchParams: Promise<{ email?: string }> }) {
  const { email } = await searchParams;
  return <EmailVerificationPage email={email || "alexandra@botanical.com"} />;
}

export default function VerifyEmailRoute({
  searchParams,
}: {
  searchParams: Promise<{ email?: string }>;
}) {
  return <VerifyEmailContent searchParams={searchParams} />;
}
